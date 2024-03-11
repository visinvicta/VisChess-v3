document.addEventListener('DOMContentLoaded', function() {
    const chessboards = document.querySelectorAll('.gamecontainer');

    chessboards.forEach(function (boardContainer) {
        const analysisBoard = boardContainer.querySelector('.gameboard');
        const pgnDataElement = boardContainer.querySelector('.gamepgn');
        
        if (analysisBoard && pgnDataElement) {
            const pgnData = pgnDataElement.textContent.trim();
            const id = analysisBoard.id;
            const config = {
                position: 'start',
                showNotation: false,
            };

            const board = Chessboard(id, config);
            const game = new Chess();
            game.load_pgn(pgnData);

           
            board.position(game.fen());
        }
    });
});
