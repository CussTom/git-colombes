// ma version
function verifMultiple(...numbers){
    let result = true;
        for(let nombres of numbers){
            if(nombres%numbers[0] !== 0){
                result = false;
            }
        }
        return result;  
    };


    // CORRECTION


