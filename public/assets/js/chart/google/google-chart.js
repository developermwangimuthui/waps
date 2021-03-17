google.charts.load('current', { packages: ['corechart', 'bar'] });
google.charts.load('current', { 'packages': ['line'] });
google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawBasic);
function drawBasic() {

    
    var campaign_id;
    campaign_id = $("#campaign_id").val();
    $.ajax({
        url: "/getMonthlyCampaignDistance/" + campaign_id,
        success: function (result) {
            console.log(result);
            var MyDataMonth = [];
            var MyDataDistance = [];
            console.log(result.months.length);
            if ($("#monthly-campaign-area-chart1").length > 0) {
                for (let i = 0; i < result.months.length; i++) {
                    MyDataMonth.push(result.months[i]);
                    MyDataDistance.push(result.MonthlyDistanceCovervedData[i]);
                    var data = google.visualization.arrayToDataTable([

                        ['Months', 'Distance'],
                        [result.months[i], parseInt(result.MonthlyDistanceCovervedData[i])],



                    ]);

                }
                console.log("months"+MyDataMonth);
                console.log("Distance"+MyDataDistance);

                var options = {
                    title: 'Monthly Distance Covered',
                    hAxis: { title: 'Days', titleTextStyle: { color: '#333' } },
                    vAxis: { minValue: 0 },
                    width: '100%',
                    height: result.max,
                    colors: [CubaAdminConfig.secondary]
                };
                var chart = new google.visualization.AreaChart(document.getElementById('monthly-campaign-area-chart1'));
                chart.draw(data, options);
            }
        }
    });


    if ($("#daily-campaing-area-chart1").length > 0) {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses'],
            ['2013', 1000, 400],
            ['2014', 1170, 460],
            ['2015', 660, 1120],
            ['2016', 1030, 540]
        ]);
        var options = {
            title: 'Company Performance',
            hAxis: { title: 'Year', titleTextStyle: { color: '#333' } },
            vAxis: { minValue: 0 },
            width: '100%',
            height: 400,
            colors: [CubaAdminConfig.primary, CubaAdminConfig.secondary]
        };
        var chart = new google.visualization.AreaChart(document.getElementById('daily-campaing-area-chart1'));
        chart.draw(data, options);
    }
}
