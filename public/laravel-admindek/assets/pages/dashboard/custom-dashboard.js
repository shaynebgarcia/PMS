"use strict";
function floatchart() {
    var e= {
        legend: {
            show: !1
        }
        ,
        series: {
            label:"",
            curvedLines: {
                active: !0, nrSplinePoints: 20
            }
        }
        ,
        tooltip: {
            show: !0, content: "x : %x | y : %y"
        }
        ,
        grid: {
            hoverable: !0, borderWidth: 0, labelMargin: 0, axisMargin: 0, minBorderMargin: 0
        }
        ,
        yaxis: {
            min:0,
            max:30,
            color:"transparent",
            font: {
                size: 0
            }
        }
        ,
        xaxis: {
            color:"transparent",
            font: {
                size: 0
            }
        }
    }
    ,
    a= {
        legend: {
            show: !1
        }
        ,
        series: {
            label:"",
            curvedLines: {
                active: !0, nrSplinePoints: 20
            }
        }
        ,
        tooltip: {
            show: !0, content: "x : %x | y : %y"
        }
        ,
        grid: {
            hoverable: !0, borderWidth: 0, labelMargin: 0, axisMargin: 0, minBorderMargin: 8
        }
        ,
        yaxis: {
            min:0,
            max:30,
            color:"transparent",
            font: {
                size: 0
            }
        }
        ,
        xaxis: {
            color:"transparent",
            font: {
                size: 0
            }
        }
    }
    ;
}

$(document).ready(function() {
    floatchart(), $(window).on("resize", function() {
        floatchart()
    }
    ), $("#mobile-collapse").on("click", function() {
        setTimeout(function() {
            floatchart()
        }
        , 700)
    }
    ), $(".scroll-widget").slimScroll( {
        size: "5px", height: "290px", allowPageScroll: !1
    }
    );
}

);