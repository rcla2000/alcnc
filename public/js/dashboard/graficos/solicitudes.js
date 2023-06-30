// -------------------------------------------------------------------------------------------------
// Gráfico de barras de tipos de solicitudes
// -------------------------------------------------------------------------------------------------

let root = am5.Root.new("barrasTipoSolicitud"); 
let chart = root.container.children.push( 
  am5xy.XYChart.new(root, {
    panY: false,
    layout: root.verticalLayout
  }) 
);

// Craete Y-axis
let yAxis = chart.yAxes.push( 
  am5xy.ValueAxis.new(root, { 
    renderer: am5xy.AxisRendererY.new(root, {}) 
  }) 
);

// Create X-Axis
let xAxis = chart.xAxes.push(
  am5xy.CategoryAxis.new(root, {
    renderer: am5xy.AxisRendererX.new(root, {}),
    categoryField: "tipo"
  })
);
xAxis.data.setAll(barrasSolicitudes);

// Create series
let series1 = chart.series.push( 
  am5xy.ColumnSeries.new(root, { 
    name: "Tipo de solicitud", 
    xAxis: xAxis, 
    yAxis: yAxis, 
    valueYField: "valor", 
    categoryXField: "tipo" ,
    tooltip: am5.Tooltip.new(root, {
        labelText: "{tipo}: {valueY}"
    })
  }) 
);

series1.columns.template.set("tooltipText", "{valueY}");
series1.data.setAll(barrasSolicitudes);
root._logo.dispose();

// -------------------------------------------------------------------------------------------------
// Gráfico de pastel de solicitudes completadas y pendientes
// -------------------------------------------------------------------------------------------------

root = am5.Root.new("pastel");
chart = root.container.children.push(am5percent.PieChart.new(root, {
    layout: root.verticalHorizontal,
    radius: am5.percent(75)
}));

let series = chart.series.push(
    am5percent.PieSeries.new(root, {
        name: "Series",
        categoryField: "tipo",
        valueField: "valor",
        alignLabels: false
    })
);

// La variable solicitudes es enviada desde el controlador de Laravel usando el paquete JavaScript
series.get("colors").set("colors", [
    am5.color(0x007bff),
    am5.color(0xffc107)
]);

series.labels.template.set("text", "{category}: ({value}) {valuePercentTotal.formatNumber('0.00')}%[/]");

series.labels.template.setAll({
  inside: true
});

series.data.setAll(solicitudes);
root._logo.dispose();

