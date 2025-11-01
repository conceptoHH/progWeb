let body = document.getElementById('cuerpo')
function texto(msj,tipoletra,tamaño,color,alineacion) {
    let div = document.createElement('div');
    let p = document.createElement('p');


    switch (tipoletra) {
        case 1:
            p.className = 'sour-gummy'
            p.style = `font-size:${tamaño}px;color:${color};text-align:${alineacion};`
            break;
        case 2:
            p.className = 'kablammo'
            p.style = `font-size:${tamaño}px;color:${color};text-align:${alineacion};`
            break;
        case 3:
            p.className = 'akaya-kanadaka-regular'
            p.style = `font-size:${tamaño}px;color:${color};text-align:${alineacion};`
            break;
        default:
            p.style = `font-size:${tamaño}px;color:${color};text-align:${alineacion};font-family:Arial, Helvetica, sans-serif;`
            break;
    }

    p.textContent = msj;
    console.log(p.getAttribute('font'));

    div.appendChild(p);

    body.appendChild(div);
}

texto('hola',1,20,'red','left');
texto('Adios',2,40,'purple','center');
texto('Yahir Molina',3,60,'blue','right');