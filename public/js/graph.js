
function drawGraph(data){


    var chart = anychart.pie(data);


    chart.innerRadius("65%");
    chart.palette(["#ff9f1c", "#ffbf69", "#2ec4b6", ]);
    chart.legend().useHtml(true);
    chart.legend().itemsFormat(
        "<span style='color:#455a64;font-weight:600; font-size: large' title='' >{%title}: </span> <span style='font-size: large' ><b>{%value}x</b>   {%x}</span>"
    );


    chart.tooltip().useHtml(true);
    chart.tooltip().titleFormat("<span style='font-weight:600; font-size: large' >{%title}:</span> <span style='font-weight:200; font-size: large' >{%x}</span>");
    chart.tooltip().format("<span style='font-weight:600; font-size: large' >ANO:</span> <span style='font-weight:200; font-size: large' >{%value}x </span><br> <span style='font-weight:600; font-size: large' >NE:</span> <span style='font-weight:200; font-size: large' >{%no}x</span>");
    chart.container("graph");

    chart.draw();

    setTimeout(function (){document.getElementsByClassName('anychart-credits')[0].remove()},10);
}
