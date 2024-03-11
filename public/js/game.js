var board = null
var game = new Chess()
var $status = $('#status')
var $fen = $('#fen')
var $pgn = $('#pgn')
board = Chessboard('analysisboard', config)

var config = {
    position: 'start',
}

let currentMove = 0;
let gamePGN = [];
let moveCount = 0;

document.addEventListener('DOMContentLoaded', function () {
    let pgnDataElement = document.querySelector('.boardgamepgn'); 
    if (pgnDataElement) {
        let pgnData = pgnDataElement.textContent.trim(); 
        game.load_pgn(pgnData);
        gamePGN = pgnData.replace(/\d+\.\s+/g, '').split(/\s+/).filter(move => move.trim() !== '');
        currentMove = gamePGN.length
        moveCount = gamePGN.length
        updateStatusAll();
    }
})

function nextMove() {
  let newPGN = gamePGN.slice(0, currentMove).join(' ')
  game.load_pgn(newPGN)
  updateStatusNoPGN()
  
}