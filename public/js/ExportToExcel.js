function ExportToExcel (dataSource,ReportTitle, label) {
        var arrData;
            arrData=typeof dataSource != 'object' ? JSON.parse(dataSource) : dataSource;
        var Excel = '';    
        //Set Report title in first row or line
        Excel += ReportTitle + '\r\n\n';

        //This condition will generate the Label/Header
        if (label) {
            var row = "";
        
            //This loop will extract the label from 1st index of on array
            for (var index in arrData[0]) {
            
                //Now convert each value to string and comma-seprated
                row += index + ',';
            }

            row = row.slice(0, -1);
        
            //append Label row with line break
            Excel += row + '\r\n';
        }
    
        //1st loop is to extract each row
        for (var i = 0; i < arrData.length; i++) {
            var row = "";
        
            //2nd loop will extract each column and convert it in string comma-seprated
            for (var index in arrData[i]) {
                row += '"' + arrData[i][index] + '",';
            }

            row.slice(0, row.length - 1);
           
            Excel += row + '\r\n';
        }

        if (Excel == '') {        
            return;
        }   
    
        //Generate a file name
        var fileName = "CSVReport_";
        //this will remove the blank-spaces from the title and replace it with an underscore
        fileName += ReportTitle.replace(/ /g,"_");   
    
        //Initialize file format you want csv or xls
        var uri = 'data:text/csv;charset=utf-8,' + escape(Excel);
        var link = document.createElement("a");    
        link.href = uri;
    
        link.style = "visibility:hidden";
        link.download = fileName + ".csv";
    
        //this part will append the anchor tag and remove it after automatic click
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
