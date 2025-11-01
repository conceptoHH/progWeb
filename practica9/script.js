let tabla =  document.getElementById('tabla');
let nombre,años,sueldo, rfc;
let id = 1


function agregarpersonal() {

    nombre = document.getElementById('personal').value;
    años = document.getElementById('años').value;
    sueldo = document.getElementById('sueldo').value;
    rfc =  document.getElementById('rfc').value;
    let data1,data2,data3,data4,data5,data6,img,url;

    validaraños(años)
    
    console.log(nombre);
    
    data1 = document.createElement('td')
    data2 = document.createElement('td')
    data3 = document.createElement('td')
    data4 = document.createElement('td')
    data5 = document.createElement('td')
    data6 = document.createElement('td')
    url = document.createElement('a')
    img = document.createElement('img')

    data1.textContent = id;
    data2.textContent = nombre;
    data3.textContent = sueldo * .3;
    data4.textContent = sueldo * 1.3;
    data5.textContent = rfc;

    url.href = `imagen${rfc}.html`;
    url.target = '_blank';
    url.rel = 'noopener noreferrer';

    img.src = `/img/${rfc}.jpg`
    img.width = 30
    img.height = 30

    data6.addEventListener('click', () => {
        verimagen();
    });

    console.log(data4)

    url.appendChild(img)

    data6.appendChild(url)
    
    let fila = document.createElement('tr')
    
    fila.appendChild(data1);
    fila.appendChild(data2);
    fila.appendChild(data3);
    fila.appendChild(data4);
    fila.appendChild(data5);
    fila.appendChild(data6);

    tabla.appendChild(fila);

    limpiardatos()

    id++;
}

function validaraños(años) {
    let nombre = document.getElementById('personal').value;
    if (años < 10) {
        document.writeln(nombre + ', No cumples con los requisitos')
    }
}

function agregarrenglones() {
    let n = prompt('¿Cuantos renglones desea?')


    for (index = 0; index < n; index++) {
        let data1 = document.createElement('td');
        let data2 = document.createElement('td');
        let data3 = document.createElement('td');
        let data4 = document.createElement('td');
        let data5 = document.createElement('td');
        let data6 = document.createElement('td');
        let fila = document.createElement('tr')

        data1.textContent = id;

        fila.appendChild(data1);
        fila.appendChild(data2);
        fila.appendChild(data3);
        fila.appendChild(data4);
        fila.appendChild(data5);
        fila.appendChild(data6);
        tabla.appendChild(fila);

        id++
    }
}

function verimagen() {
    document.open('imagenhombre.html');
}

function limpiardatos() {
    nombre = document.getElementById('personal')
    años = document.getElementById('años')
    sueldo = document.getElementById('sueldo')

    nombre.value = ' ';
    años.value = ' ';
    sueldo.value = ' ';
}



