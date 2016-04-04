jQuery(document).ready(function($){
    $('#user_data_search').keyup(function(){
        var searchTerm = $('#user_data_search').val();
        var table = $('#user_data_table');
        table.find('tr.parent').each(function(index,row){
           var allCells = $(row).find('td');
           if(allCells.length > 0){
               var found = false;
               allCells.each(function(index,td){
                  var regExp = new RegExp(searchTerm,'i');
                  if(regExp.test($(td).text())){
                      found = true;
                      return false;
                  } 
               });
               if(found == true)$(row).show();
               else $(row).hide();
           } 
        });
    });
});
