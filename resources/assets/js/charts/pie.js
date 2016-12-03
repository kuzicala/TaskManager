/**
 * Created by Administrator on 2016-12-03.
 */
ctx = $('#pieChart');
var data = {
    datasets: [{
        data: [
            $("#pie").data("todocount"),
            $("#pie").data("donecount")
],
backgroundColor: [
    "#FF6384",
    "#4BC0C0"
]
}],
labels: [
    "未完成",
    "已完成"
]
};
var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: data,
    options: {
        responsive:true,
        title:{
            display:true,
            text:'所有任务完成的比例(总数:  '+$("#pie").data("total")
        }
    }
});