let body = document.getElementById('cuerpo')
function texto(msj,tamaño,color) {
    let div = document.createElement('div');
    let p = document.createElement('font');

    p.textContent = msj;
    p.size = tamaño;
    p.color = color;
    console.log(p.getAttribute('font'));

    div.appendChild(p);

    body.appendChild(div);
}

function suma(num1,num2) {
    let resultado = num1 + num2;
    return resultado;
}

// console.log(suma(5,30));
// console.log(suma(10,60));
// console.log(suma(300,80));
// console.log(suma(50,90));

// document.writeln(suma(5,30));
// document.writeln(suma(10,60));
// document.writeln(suma(300,80));
// document.writeln(suma(50,90));

texto('hola', 7, 'red');
texto('adios', 5, 'blue');
texto('Yahir Molina', 6, 'magenta');
texto('Ing. en Sistemas Computacionales', 4, 'green');
texto('Tecnológico Nacional de México Campus Acapulco', 3, 'grey');