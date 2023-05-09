function openForm() {
    document.getElementById("popup-Form").style.display = "block";
    }
    function closeForm() {
    document.getElementById("popup-Form").style.display = "none";
    }

    /*-----------------dashboard----------------*/

    var i = 0 ;
        function showNumberTrain() {
        if(i < 92) {
        		i++;
                document.getElementById('showNumberTrain').innerHTML= i;

        }
    }

    
     var j = 0 ;
        function showNumberTransit() {
        if(j < 23) {
        		j++;
                document.getElementById('showNumberTransit').innerHTML= j;

        }
    } 

    var k = 0 ;
        function showNumberUser() {
        if(k < 30) {
        		k++;
                document.getElementById('showNumberUser').innerHTML= k;

        }
    }

    var l = 0 ;
        function showNumberStation() {
        if(l < 100) {
        		l++;
                document.getElementById('showNumberStation').innerHTML= l;

        }
    }

    function showStatFunction(){

        showNumberTrain();
        showNumberStation();
        showNumberUser();
        showNumberTransit();
    }