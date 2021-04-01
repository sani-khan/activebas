var ip="http://localhost/activebas";
function IndexViewModel() {
    var self = this; 
    self.get_all_record = ko.observableArray();
    self.Total_fee = ko.observable(0);
    // get record from filter employee name and event name
    self.filter_result=function(type,text){
        fetch(ip+'/server.php?type=' + type+'&text='+text).then(x => {

            x.json().then(b => {
                self.get_all_record.removeAll();
                self.Total_fee(0);
                for(let x in b){
                    if(b[x]["participation_fee"]){
                        self.Total_fee(parseInt(self.Total_fee())+parseInt(b[x]["participation_fee"]));

                    }
                    self.get_all_record.push(b[x])
                }
            })
        })
    } 
    // get record from filter dates
    self.filter_result_date=function(type,fromDate,toDate){
        fetch(ip+'/server.php?type=' + type+'&fromdate='+fromDate+'&todate='+toDate).then(x => {

            x.json().then(b => {
                self.get_all_record.removeAll();
                self.Total_fee(0);
                for(let x in b){
                    if(b[x]["participation_fee"]){
                        self.Total_fee(parseInt(self.Total_fee())+parseInt(b[x]["participation_fee"]));

                    }
                    self.get_all_record.push(b[x])
                }
            })
        })
    } 
    //get all the Records
    self.get_record=function(type){
        fetch(ip+'/server.php?type=' + type).then(x => {

            x.json().then(b => {
                self.get_all_record.removeAll();
                self.Total_fee(0);
                for(let x in b){
                    if(b[x]["participation_fee"]){
                        self.Total_fee(parseInt(self.Total_fee())+parseInt(b[x]["participation_fee"]));

                    }
                    self.get_all_record.push(b[x])
                }
            })
        })
    }
}
var ViewM = new IndexViewModel();
GetAllRecords();
ko.applyBindings(ViewM);
function GetAllRecords(){
    
ViewM.get_record("all");
}
// clear filtering 
clearfilterData =()=>{
    $("#filterbtn").css("display","block");
    $("#clearfilterbtn").css("display","none");
ViewM.get_record("all");
}
// data filtering 
filterData =()=>{
    $("#clearfilterbtn").css("display","block");
    $("#filterbtn").css("display","none");
    var selectoption=$("#filter_option").val();
    if(selectoption=="date"){
        var toDate = new Date();
        toDate = dateToYMD($('#to_short_date').data('datetimepicker').getDate());
        var fromDate = new Date();
        fromDate = dateToYMD($('#from_short_date').data('datetimepicker').getDate());
        ViewM.filter_result_date(selectoption,fromDate,toDate);
    }
    else{
        var text=$("#searched_text").val();
        ViewM.filter_result(selectoption,text);
    }
}
//format date from date picker to 2000-09-01
function dateToYMD(date) {
    var d = date.getDate();
    var m = date.getMonth() + 1; //Month from 0 to 11
    var y = date.getFullYear();
    return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
}