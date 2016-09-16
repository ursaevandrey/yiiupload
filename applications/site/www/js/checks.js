(function($){

    var text_backup,
        methods = {
            enable: function(text){
                this.removeAttr('disabled');
                this.removeClass('disabled');
                this.checks('text', text);
            },
            disable: function(text){
                this.attr('disabled', 'disabled');
                this.addClass('disabled');
                this.checks('text', text);
            },
            text: function(text){
                _bkText(this);
                this.text(text ? text : text_backup);
            },
            revert_text: function(timeout){ // revert text by timeout
                var self = this;
                window.setTimeout(function(){
                    self.text(text_backup);
                }, timeout);
            }
        };

    $.fn.checks = function(method){
        if(methods[method]){
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1))
        }
    };

    /**
     * Backup button text
     *
     * @param e object
     * @private
     */
    function _bkText(e){
        if(!text_backup){
            text_backup = e.text();
        }
    }

})(jQuery);