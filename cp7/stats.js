// Evenement CHANGE sur YEAR
document.getElementById('year').addEventListener(
    'change',
    redrawChart
);

document.getElementById('emp').addEventListener(
    'change',
    redrawChart
);

// Redessine le chart
function redrawChart(){
    let eYear = document.getElementById('year');
    let eEmp = document.getElementById('emp');
    let eChart = document.getElementById('chart');
    let eE = document.getElementById('e');
    let eA = document.getElementById('a');
    eChart.src = 'chart.php?e='+eEmp.value+'&a='+eYear.value;
    eE.src = 'chart.php?e='+eE.value;
    eA.src = 'chart.php?a='+eA.value;


    // AUTRE METHODE
        // document.getElementById('chart').src = 'chart.php?e='+document.getElementById('emp').value +'&a='+.document.getElementById('year').value;
}