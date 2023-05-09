
const trainCards = document.getElementsByClassName('train-card');
const trainStopMenus = document.getElementsByClassName('train-stops-menu');

function openMenu(e){e.style = 'grid-template-rows: 1fr';}
function closeMenu(e){e.style = 'grid-template-rows: 0fr';}
function arrowUp(e){e.style = 'transform: rotate(-180deg)';}
function arrowDown(e){e.style = 'transform: rotate(0deg)';}

for (let i = 0; i < trainCards.length; i++) {
    
    const ulLists = document.getElementsByClassName('train-list-container');

    for (const ulList of ulLists) {
        if (ulList.innerHTML !== null) {
    
            const cards = trainCards[i];
            const menu = trainStopMenus[i];
            const destinfo = document.getElementById('dest-info');
            const arrow = document.createElement('i');
    
            cards.setAttribute('id', 'train-card-'+i);
            menu.setAttribute('id', 'train-stops-menu-'+i);
            destinfo.setAttribute('id', 'destInfo-'+i);

            arrow.classList.add('bi');
            arrow.classList.add('bi-caret-down');
            arrow.classList.add('mx-2');
            arrow.classList.add('fs-2');
            arrow.classList.add('align-middle');
            arrow.classList.add('d-inline-block');
            arrow.setAttribute('id', 'caret-down-'+i);
    
            destinfo.appendChild(arrow);
    
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
    }

}
