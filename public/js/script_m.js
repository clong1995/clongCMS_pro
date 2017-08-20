var jobList = document.getElementById('list_d').childNodes[2];

var dlArr = jobList.childNodes;
for (var d = 0; d < dlArr.length; ++d) {
    var ddList = dlArr[d].childNodes[2];
    if (ddList != undefined) {
        var divv = ddList.childNodes[1];
        var reviw = divv.childNodes[0];
        var xz = reviw.lastChild.innerHTML;
        if(parseInt(xz.substr(5,5)) >= 7000){
            console.log(ddList);
        }
    }
}
