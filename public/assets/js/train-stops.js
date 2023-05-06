const trainStopsBtn = document.getElementById('train-stops-menu-btn');
const trainStopsMenu = document.getElementById('train-stops-menu');
const trainCard = document.getElementById('train-card');
const trainStopsArrow = document.getElementById('caret-down');

function openMenu(e){
    e.style = 'grid-template-rows: 1fr';
}

function closeMenu(e){
    e.style = 'grid-template-rows: 0fr';
}

function arrowUp(e){
    e.style = 'transform: rotate(180deg)';
}

function arrowDown(e){
    e.style = 'transform: rotate(0deg)';
}

trainCard.addEventListener('mouseover', function(){
    openMenu(trainStopsMenu);
    arrowUp(trainStopsArrow);
})

trainCard.addEventListener('mouseout', function(){
    closeMenu(trainStopsMenu);
    arrowDown(trainStopsArrow);
})