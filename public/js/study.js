var board = null
var game = new Chess()
var $status = $('#status')
var $fen = $('#fen')
var $pgn = $('#pgn')
board = Chessboard('studyboard', config)
updateStatusAll()

var config = {
  position: 'start',
}

let moveCount = 0
let currentMove = 0
let gamePGN = []
let currentChapterId = 0

function nextMove() {
  let newPGN = gamePGN.slice(0, currentMove).join(' ')
  game.load_pgn(newPGN)
  updateStatusNoPGN()
  showCommentsByMove(currentChapterId, currentMove)
  updateMoveNumberField(currentMove)
}

function goToMove(goToMoveNumber) {
  let newPGN = gamePGN.slice(0, goToMoveNumber).join(' ')
  game.load_pgn(newPGN)
  updateStatusNoPGN()
  showCommentsByMove(currentChapterId, goToMoveNumber)
  updateMoveNumberField(currentMove)
}

$(document).ready(function () {
  $('.chapter-list li').click(function () {
    let chapterId = $(this).attr('id')
    currentChapterId = chapterId
    fetchChapterData(chapterId)
  });

  function fetchChapterData(chapterId) {
    $.ajax({
      url: '/get-chapter-pgn/' + chapterId,
      method: 'GET',
      success: function (response) {
        let pgnData = response.pgn
        gamePGN = pgnData.replace(/\d+\.\s+/g, '').split(/\s+/).filter(move => move.trim() !== ''); //transform PGN with numbers to PGN without numbers
        moveCount = gamePGN.length
        currentMove = moveCount
        goToMove(moveCount)
        updateStatusAll()
        showCommentsByMove(chapterId, currentMove)
        generateTable(gamePGN)
      },
      error: function (xhr, status, error) {
        console.error('Error fetching chapter PGN:', error)
      }
    });
  }
});

function updateMoveNumberField(moveNumber) {
  let moveNumberField = document.getElementById('moveNumber')
  moveNumberField.value = moveNumber
}

document.getElementById('addcomment').addEventListener('click', function () {
  updateMoveNumberField(currentMove);
});

function showCommentsByMove(chapter, move) {
  $('.comment-item').hide();
  $('.move-' + move + '.chapter-' + chapter).show();
}

// moves table

function generateTable(gamePGN) {
  const tbody = document.getElementById('moves-table-body')
  tbody.innerHTML = ''

  let moveNumber = 1
  let moveHeader = 1

  for (let i = 0; i < gamePGN.length; i++) {
    const gameMove = gamePGN[i]
    const row = document.createElement('tr')

    if (i % 2 === 0) {
      moveHeader = Math.floor(moveNumber / 2) + 1
      row.innerHTML = `
        <td>${moveHeader}</td>
        <td class="tablemove move-${moveNumber}">${gameMove}</td>
      `;
    } else {
      row.innerHTML = `
        <td class="tablemove move-${moveNumber}">${gameMove}</td>
      `;
      tbody.lastElementChild.appendChild(row);
    }

    if (i % 2 === 0) {
      tbody.appendChild(row)
    }

    moveNumber++
  }
}

document.addEventListener('click', function (event) {
  if (event.target.classList.contains('tablemove')) {
    const moveNumber = event.target.classList[1].split('-')[1]
    currentMove = moveNumber
    goToMove(moveNumber)
    updateMoveNumberField(moveNumber)
  }
});


const commentsbtn = document.getElementById('toggle-comments-btn');

commentsbtn.addEventListener('click', function () {
    const comments = document.querySelector('.toggle-comments');
    comments.classList.toggle('hidden');
});

const pgnbtn = document.getElementById('toggle-pgn-btn');

pgnbtn.addEventListener('click', function () {
    const pgn = document.querySelector('.toggle-pgn');
    pgn.classList.toggle('hidden');
});

