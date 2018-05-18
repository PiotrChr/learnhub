var AdminLTEOptions = {
    enableBSToppltip: true
};

var domain = 'http://learnhub';

if("undefined"==typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");


var jqueryInterface = {

    behaviour: {
        radioButtons: function() {
            $('.choice-button').on('click',function() {
                var refId = $(this).attr('rel');
                $('#'+refId).prop('checked',true);
                $(this).trigger('click');
            });
        },
        autocompleteCategory: function() {
            var ms = $('.magicsuggestCat');
            if (ms.length > 0) {
                ms.magicSuggest({
                    data: domain + '/a/getCategoryByName',
                    valueField: 'id',
                    displayField: 'path_html',
                    method: 'get',
                    selectionStacked: true,
                    selectionPosition: 'bottom',
                    selectionRenderer: function(data){
                        return data['path_html'];
                    },
                    selectionContainer: $('div.relevant-box'),
                    allowFreeEntries: false

                });
            }
        },
        autocompleteTag: function() {
            var ms2 = $('.magicsuggestTag');
            if (ms2.length > 0) {
                ms2.magicSuggest({
                    data: domain + '/a/getTagByName',
                    valueField: 'id',
                    displayField: 'name',
                    method: 'get',
                    selectionStacked: true,
                    selectionRenderer: function(data){
                        return data['name'];
                    },
                    selectionContainer: $('div.tag-box'),
                    allowFreeEntries: true

                });
            }
        },
        loader: function() {
            $.each(this, function() {
                if (this !== jqueryInterface.behaviour.loader) {
                    this();
                }
            })
        }
    },
    
    run: function() {
        jqueryInterface.behaviour.loader();
    }
};

jQuery(document).ready(function() {
    jqueryInterface.run();
});