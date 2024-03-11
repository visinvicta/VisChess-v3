var board = null
var game = new Chess()
var $status = $('#status')
var $fen = $('#fen')
var $pgn = $('#pgn')
board = Chessboard('analysisboard', config)
updateStatusAll()

var config = {
  position: 'start',
}

let moveCount = 0
let currentMove = 0
let gamePGN = []
let storePGN = ''

function nextMove() {
  let newPGN = gamePGN.slice(0, currentMove).join(' ')     
  game.load_pgn(newPGN)
  updateStatusAll()
}

const importField = document.getElementById("importpgn");
const importButton = document.getElementById("importpgnsubmit");

importButton.addEventListener("click", function () {
  game.load_pgn(importField.value);
  importPGN = importField.value;
  gamePGN = importPGN.replace(/\d+\.\s+/g, '').split(/\s+/).filter(move => move.trim() !== ''); 
  moveCount = gamePGN.length
  currentMove = gamePGN.length;
  storePGN = addMoveNumbers(gamePGN.join(' '))
  updateStatusAll()
})

function addMoveNumbers(gameString) {
  const moves = gameString.split(' ');
  let numberedMoves = '';
  for (let i = 0; i < moves.length; i += 2) {
      const moveNumber = Math.floor(i / 2) + 1;
      numberedMoves += moveNumber + '. ' + moves[i] + ' ' + moves[i + 1] + ' ';
  }
  numberedMoves = numberedMoves.trim();
  return numberedMoves;
}

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

async function sendDataToServer(endpoint) {
  try {
    if (moveCount !== '') {
      const response = await fetch(endpoint, {
        method: 'POST',
        headers: {
          'Content-type': 'application/json',
          'X-CSRF-TOKEN': csrfToken  
        },
        body: JSON.stringify({ 
          "pgn": storePGN,
          "whiteplayer": 'Carlsen, Magnus',
          "blackplayer": 'Nakamura, Hikaru',
          "result": 'unknown'
        })
      });

      if (!response.ok) {
        throw new Error('Failed to post data to server');
      }

      const data = await response.text();
      console.log(data);
    }
  } catch (error) {
    console.error('Error:', error.message);
  }
}

const dbbutton = document.getElementById("posttodb");
if (dbbutton) {
  dbbutton.addEventListener("click", () => sendDataToServer('/games'));
}

const mygamesbutton = document.getElementById("posttomygames");
if (mygamesbutton) {
  mygamesbutton.addEventListener("click", () => sendDataToServer('/favorites'));
}
