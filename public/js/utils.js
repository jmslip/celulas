//Mascaras
$('#calendario').mask('dd/mm/yyyy');
$('#telefone').mask('(99)9999-9999');
$('#celular').mask('(99)99999-9999');
$('#cep').mask('99999-999');

// //Tornar os widgets móveis
// $('.connectedSortable').sortable({
//     placeholder: 'sort-highlight',
//     connectWith: '.connectedSortable',
//     handle: '.box-header',
//     forcePlaceholderSize: true,
//     zIndex: 99999
// });
// $('.connectedSortable .box-header').css('cursor', 'move');

// //Gráfico
// var gCellCanvas = $('#graphCell');
// var gCell = new Chart(gCellCanvas, {
//     type: 'bar',
//     data: {
//         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255,99,132,1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero:true
//                 }
//             }]
//         }
//     }
// });

//Calendário
$('#calendario').datepicker({
    format: 'dd/mm/yyyy',
    language: 'pt-BR',
});

//Select2
$('#select-lider-celula').select2({
    maximumSelectionLength: 3,
    allowClear: true,
    language: "pt-BR"
});

$('#select-celula').select2();
