const frame = document.getElementById('f_info');
const links = document.getElementById('link');
const links2 = document.getElementById('link2');
const links3 = document.getElementById('link3');

const urlOriginal = frame.scr;

links.addEventListener('click', () => {
    frame.src = 'informacion.html';
} );
links2.addEventListener('click', () => {
    frame.src = 'informacion.html';
} );
links3.addEventListener('click', () => {
    frame.src = 'informacion.html';
} );

