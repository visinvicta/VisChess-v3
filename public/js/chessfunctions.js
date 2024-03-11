function updateStatusAll() {
    let status = ''
    let moveColor = 'White'
    if (game.turn() === 'b') {
      moveColor = 'Black'
    }
    if (game.in_checkmate()) {
      status = 'Game over, ' + moveColor + ' is in checkmate.'
    }
    else if (game.in_draw()) {
      status = 'Game over, drawn position'
    }
  
    else {
      status = moveColor + ' to move'
      if (game.in_check()) {
        status += ', ' + moveColor + ' is in check'
      }
    }
  
    board.position(game.fen());
    $status.html(status)
    $fen.html(game.fen())
    $pgn.html(game.pgn())
}

function updateStatusNoPGN(status) {
    board.position(game.fen());
    $status.html(status)
    $fen.html(game.fen())
}


// Next move buttons + arrow keys

const leftscroll = document.getElementById("previousmove");
const rightscroll = document.getElementById("nextmove");
const firstMoveButton = document.getElementById("firstmove");
const lastMoveButton = document.getElementById("lastmove");

leftscroll.addEventListener('click', function () {
  if (currentMove > 0) {
    currentMove--;
    nextMove();
  }
  console.log(`Game Move Count: ${currentMove}`);
});

rightscroll.addEventListener('click', function () {
  if (currentMove < moveCount) {
    currentMove++;
    nextMove();
  }
  console.log(`Game Move Count: ${currentMove}`);
});

firstMoveButton.addEventListener('click', function () {
  currentMove = 0;
  nextMove();
  console.log(`Game Move Count: ${currentMove}`);
});

lastMoveButton.addEventListener('click', function () {
  currentMove = moveCount;
  nextMove();
  console.log(`Game Move Count: ${currentMove}`);
});

document.addEventListener('keydown', function (event) {
  switch (event.key) {
    case 'ArrowLeft':
      if (currentMove > 0) {
        currentMove--;
        nextMove();
      }
      event.preventDefault();
      break;
    case 'ArrowRight':
      if (currentMove < moveCount) {
        currentMove++;
        nextMove();
      }
      event.preventDefault();
      break;
    case 'ArrowUp':
      currentMove = 0;
      nextMove();
      event.preventDefault();
      break;
    case 'ArrowDown':
      currentMove = moveCount;
      nextMove();
      event.preventDefault();
      break;
  }
  console.log(`Game Move Count: ${currentMove}`);
});
const flipboard = document.getElementById("flipboard")
flipboard.addEventListener("click", () => {
    board.flip()
})

