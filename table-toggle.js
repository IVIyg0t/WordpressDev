jQuery(document).ready(function($){
    $("tr.parent")
        .attr("title","Click to expand/collapse")
        .click(function(){
            $(this).siblings('.child-'+this.id).slideToggle("fast");
    });
});
