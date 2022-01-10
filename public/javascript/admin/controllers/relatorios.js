$(document).ready(function () {

    function relmes2() {
        $.ajax({
            url: '//' + window.location.host + '/clinica/admin/relatorios/getmes',
            method: "GET",
            success: function(data) {
                var qtde = new Array();
                var mes = new Array();
                var cor = [];

                for (var i in data) {
                    //console.log(data);
                    qtde.push(data[i].qtde);
                    mes.push(data[i].mes);
                    cor.push(data[i].cor);
                }

                var chartdata = {
                    labels: getmes(mes),
                    datasets: [{
                        label: ['Total'],
                        backgroundColor: getColors(12),
                        //backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: qtde
                    }]
                };

                var cty = $("#relmes");

                Chart.pluginService.register({
                    beforeRender: function(chart) {
                        if (chart.config.options.showAllTooltips) {
                            chart.pluginTooltips = [];
                            chart.config.data.datasets.forEach(function(dataset, i) {
                                chart.getDatasetMeta(i).data.forEach(function(sector, j) {
                                    chart.pluginTooltips.push(new Chart.Tooltip({
                                        _chart: chart.chart,
                                        _chartInstance: chart,
                                        _data: chart.data,
                                        _options: chart.options.tooltips,
                                        _active: [sector]
                                    }, chart));
                                });
                            });
                            chart.options.tooltips.enabled = false;
                        }
                    },
                    afterDraw: function(chart, easing) {
                        if (chart.config.options.showAllTooltips) {
                            if (!chart.allTooltipsOnce) {
                                if (easing !== 1)
                                    return;
                                chart.allTooltipsOnce = true;
                            }

                            chart.options.tooltips.enabled = true;
                            Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
                                tooltip.initialize();
                                tooltip.update();
                                tooltip.pivot();
                                tooltip.transition(easing).draw();
                            });
                            chart.options.tooltips.enabled = false;
                        }
                    }
                });

                var barGraph = new Chart(cty, {
                    type: 'bar',
                    data: chartdata,
                    options: {
                        legend: { display: false, position: 'right', align: 'start' },
                        title: {
                            display: true,
                            text: 'Total por Mês '
                        },
                        showAllTooltips: true,
                        tooltips: {
                            callbacks: {
                                title: function(tooltipItems, data) {
                                    return '';
                                },
                                label: function(tooltipItem, data) {
                                    var datasetLabel = '';
                                    var label = data.labels[tooltipItem.index];
                                    return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                }
                            }
                        }
                    }
                });
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function relmes() {
        $.ajax({
            url: '//' + window.location.host + '/clinica/admin/relatorios/getmes',
            method: "GET",
            success: function(data) {
                var total = new Array();
                var mes = new Array();
                var nome = [];
                var cor = [];

                for (var i in data) {
                    //console.log(data);
                    total.push(data[i].total);
                    mes.push(data[i].mes);
                    nome.push(data[i].nome);
                    cor.push(data[i].cor);
                }

               

                var chartdata = {
                    labels: getmes(mes),
                    datasets: [{
                        label: ['Total '],
                        backgroundColor: getColors(12),
                        //backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: total

                    }]
                };

                var cty = $("#relmes");

                Chart.pluginService.register({
                    beforeRender: function(chart) {
                        if (chart.config.options.showAllTooltips) {
                            chart.pluginTooltips = [];
                            chart.config.data.datasets.forEach(function(dataset, i) {
                                chart.getDatasetMeta(i).data.forEach(function(sector, j) {
                                    chart.pluginTooltips.push(new Chart.Tooltip({
                                        _chart: chart.chart,
                                        _chartInstance: chart,
                                        _data: chart.data,
                                        _options: chart.options.tooltips,
                                        _active: [sector]
                                    }, chart));
                                });
                            });
                            chart.options.tooltips.enabled = false;
                        }
                    },
                    afterDraw: function(chart, easing) {
                        if (chart.config.options.showAllTooltips) {
                            if (!chart.allTooltipsOnce) {
                                if (easing !== 1)
                                    return;
                                chart.allTooltipsOnce = true;
                            }

                            chart.options.tooltips.enabled = true;
                            Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
                                tooltip.initialize();
                                tooltip.update();
                                tooltip.pivot();
                                tooltip.transition(easing).draw();
                            });
                            chart.options.tooltips.enabled = false;
                        }
                    }
                });

                var barGraph = new Chart(cty, {
                    type: 'bar',
                    data: chartdata,
                    options: {
                        legend: { display: false, },
                        title: {
                            display: true
                            
                        },
                        showAllTooltips: true,
                        tooltips: {
                            callbacks: {
                                title: function(tooltipItems, data) {
                                    return '';
                                },
                                label: function(tooltipItem, data) {
                                    var datasetLabel = '';
                                    var label = data.labels[tooltipItem.index];
                                    return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                }
                            }
                        }

                    }
                });

            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    //----fim ----------
  

    function barchart() {
        var ctx = $('#barChart').get(0).getContext('2d');

        var data = {
            labels: ["Chocolate", "Vanilla", "Strawberry"],
            datasets: [
                {
                    label: "Blue",
                    backgroundColor: "blue",
                    data: [3, 7, 4]
                },
                {
                    label: "Red",
                    backgroundColor: "red",
                    data: [4, 3, 5]
                },
                {
                    label: "Green",
                    backgroundColor: "green",
                    data: [7, 2, 6]
                }
            ]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }]
                }
            }
        });

    }

    function initGraph() {
        relmes();
        

        //fim-----
       
        //barchart();
    }

    //Metodo prático de validar vazios em JS
    function testa_empty(val) {
        if (val === undefined)
            return true;
        if (typeof (val) == 'function' || typeof (val) == 'number' || typeof (val) == 'boolean' || Object.prototype.toString.call(val) === '[object Date]')
            return false;
        if (val == null || val.length === 0) // null or 0 length array
            return true;
        if (typeof (val) == "object") {
            // empty object

            var r = true;

            for (var f in val) {
                r = false;
            }
            return r;
        }
        return false;
    }

    function getSafe(fn, defaultVal) {
        try {
            return fn();
        } catch (e) {
            return defaultVal;
        }
    }

    function getColors(c = 1) {
        var cor = new Array();

        for (var i = 0; i < c; i++) {
            cor.push(getRandomColor());
        }

        return cor;
    }

    function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function getmes(mes) {
        for (var i = 0; i < 12; i++) {
            if (mes[i] == 1) mes[i] = 'janeiro';
            if (mes[i] == 2) mes[i] = 'fevereiro';
            if (mes[i] == 3) mes[i] = 'março';
            if (mes[i] == 4) mes[i] = 'abril';
            if (mes[i] == 5) mes[i] = 'maio';
            if (mes[i] == 6) mes[i] = 'junho';
            if (mes[i] == 7) mes[i] = 'julho';
            if (mes[i] == 8) mes[i] = 'agosto';
            if (mes[i] == 9) mes[i] = 'setembro';
            if (mes[i] == 10) mes[i] = 'outubro';
            if (mes[i] == 11) mes[i] = 'novembro';
            if (mes[i] == 12) mes[i] = 'dezembro';
        }
        return mes;
    }



    initGraph();

});

