
const trainCards = document.getElementsByClassName('train-card');
const trainStopMenus = document.getElementsByClassName('train-stops-menu');
const trainStopBtns = document.getElementsByClassName('bi-caret-down');

function openMenu(e){e.style = 'grid-template-rows: 1fr';}
function closeMenu(e){e.style = 'grid-template-rows: 0fr';}
function arrowUp(e){e.style = 'transform: rotate(-180deg)';}
function arrowDown(e){e.style = 'transform: rotate(0deg)';}

for (let i = 0; i < trainCards.length; i++) {
    const cards = trainCards[i];
    const menu = trainStopMenus[i];
    const btn = trainStopBtns[i];
    cards.setAttribute('id', 'train-card-'+i);
    menu.setAttribute('id', 'train-stops-menu-'+i);
    btn.setAttribute('id', 'caret-down-'+i);
    
    const trainCard = document.getElementById('train-card-'+i);
    const trainStopsMenu = document.getElementById('train-stops-menu-'+i);
    const trainStopsArrow = document.getElementById('caret-down-'+i);

    closeMenu(trainStopsMenu);
    arrowDown(trainStopsArrow);
   
    trainCard.addEventListener('mouseover', function(){
        openMenu(trainStopsMenu);
        arrowUp(trainStopsArrow);
    })

    trainCard.addEventListener('mouseout', function(){
        closeMenu(trainStopsMenu);
        arrowDown(trainStopsArrow);
    })
}
