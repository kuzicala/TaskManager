/**
 * Created by Administrator on 2016-12-03.
 */

//BAR
var data = {
    labels:$('#bar').data("names"), //不会过滤一些东西
datasets: [
    {
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)'
        ],
        borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'
        ],
        borderWidth: 1,
        data: $('#bar').data("projects")
}
]
};
bar = $('#barChart');
var myBarChart = new Chart(bar, {
    type: 'bar',
    data: data,
    options: {
        responsive:true,
        title:{
            display:true,
            text:'所有任务完成的比例(总数:  '+$("#pie").data("total")
        },
        legend:{
            display:false
        }
    }
});