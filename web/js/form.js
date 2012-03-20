function form(){
    this.editors = {};
}
form.name = 'form';
ModuleManager.add(form);


form.prototype.afterInit = function(){ 
    var self = this;
    $('#right_layout textarea').each(function(){
        var r = $(this).redactor({	
            air: false,
            toolbar: 'uber', // false, main, mini, air
            lang: 'ru', // ru, en, fr, ua, pt_br, pl		
            typo: false,
            autosave: false, // false or url
            interval: 20, // seconds
            resize: true,
            visual: true,
            focus: false,
            image_upload: false,
            imageUploadFunction: false, // callback function
			
            file_upload: false,	
            file_download: false,		
            file_delete: false,		
            fileUploadFunction: false, // callback function
			
            autoclear: true,
            remove_classes: true,
            remove_styles: true,
            convert_links: true,	
            autoformat: true,
            init_clear: false,					
            overlay: true, // modal overlay
            path: app.url("/js/lib/redactor/"),
            pathCss: 'css/',
            css: ['wym.css']
        });
        self.editors[$(this)[0].id] = r;
    })
    //    $('#right_layout textarea').tinymce({
    //        force_p_newlines : false,
    //        force_br_newlines : true,
    //        theme : "advanced",
    //        
    //        theme_advanced_buttons1 : "bold,italic,underline,link,unlink,image,bullist,numlist,blockquote,undo", 
    //        theme_advanced_buttons2 : "", 
    //        theme_advanced_buttons3 : "",
    //
    //        init_instance_callback: function(ed){
    //            var s = ed.settings;
    //            var realID = ed.id+'_ifr';
    //            tinymce.dom.Event.add(ed.getWin(), 'focus', function(e) {
    //                if($(realID)) {
    //                    $('#'+realID).contents().find('body').css('background-color','#FEFAE2');
    //                }
    //            });
    //            tinymce.dom.Event.add(ed.getWin(), 'blur', function(e) {
    //                if($(realID)) {
    //                    $('#'+realID).contents().find('body').css('background-color','#FFF');
    //                }
    //            });
    //
    //        }
    //    });
    
    
    $('#right_layout input').each(function(){
        var input = $(this);
        if(this.id.indexOf('_date')>-1){
            input.DatePicker({
                format:'d.m.Y',
                date: input.val(),
                current: input.val(),
                starts: 1,
                position: 'r',
                onChange: function(formated, dates){
                    input.val(formated);
                    input.DatePickerHide();
                }
            //                onBeforeShow: function(formated, dates){
            //                    if(input.val() == input.label){
            //                        input.val('');
            //                    }
            //                }
            });
        }
            
        if(input.attr('type') == 'file'){
            var td = input.parent();
            input.remove();
            td.append('<div class="blocker" /><input type="file" id="'+input.attr('id')+'" name="'+input.attr('name')+'" class="customFile" /><div class="fakeButton" ></div><div class="fileName" />');
                
            var newInput = $('input',td);
            var fileName = $('.fileName',td);
            var button = $('.fakeButton',td);
                
            var actTog = function(){
                button.toggleClass('active');
            };
                
            newInput.hover(actTog, actTog);                
            button.hover(actTog, actTog);
                
            newInput.change(function(){
                var fileTitle = newInput.val();
                //                    var fileTitle = file.replace(/.*(.*)/, "$1"); //выдираем название файла для windows
                //                    fileTitle = fileTitle.replace(/.*/(.*)/, "$1"); //выдираем название файла для unix-систем
                fileName.html(fileTitle);

                var ext = fileTitle.substr(fileTitle.indexOf('.')+1);
                var pos;
                if (ext) {
                    switch (ext.toLowerCase()) {
                        case 'doc':
                            pos = '0';
                            break;
                        case 'bmp':
                            pos = '16';
                            break; 
                        case 'jpg':
                            pos = '32';
                            break;
                        case 'jpeg':
                            pos = '32';
                            break;
                        case 'png':
                            pos = '48';
                            break;
                        case 'gif':
                            pos = '64';
                            break;
                        case 'psd':
                            pos = '80';
                            break;
                        case 'mp3':
                            pos = '96';
                            break;
                        case 'wav':
                            pos = '96';
                            break;
                        case 'ogg':
                            pos = '96';
                            break;
                        case 'avi':
                            pos = '112';
                            break;
                        case 'wmv':
                            pos = '112';
                            break;
                        case 'flv':
                            pos = '112';
                            break;
                        case 'pdf':
                            pos = '128';
                            break;
                        case 'exe':
                            pos = '144';
                            break;
                        case 'txt':
                            pos = '160';
                            break;
                        default:
                            pos = '176';
                            break;
                    };
                    fileName.css({
                        display: 'block',
                        background:'url(' + app.url('/images/common/buttons/userpic/icons.png') + ') no-repeat 0 -'+pos+'px'
                    });
                }
            });
                
        }
        
        var info = input.next();
        if(info.hasClass('field_info')){
            input.focus(function(){
                info.slideDown()
            }).blur(function(){
                info.slideUp()
            });
        }
        
    });
    
    $('.autocomplete').each(function(){
        var wraper = $(this);
        var baseSelect = $(wraper.find('select'));
        wraper.height(baseSelect.outerHeight());        
        $('#profileContainer').append('<input class ="autocompete_input" id="autocomplete_for_'+baseSelect.id+'" type="text">');
        var input = $('#autocomplete_for_'+baseSelect.id);
        input.css({
            top:wraper.offset().top,
            left:wraper.offset().left,
            position: 'absolute'
        }).val($('option:selected',baseSelect).html());
        baseSelect.hide();
        input.autocomplete(wraper.attr('url'),{ 
            minChars: "3", 
            formatItem: function(data, i, n, value) {
                return "<div>" + data[0]+"</div><div>"+data[1]+"</div>";
            },
            formatResult: function(data, value){
                baseSelect.html('<option selected="selected" value="'+data[2]+'">'+data[0]+'</option>');
                return data[0];
            }            
        });
        input.result(function(resp,data){
            baseSelect.html('<option selected="selected" value="'+data[2]+'">'+data[0]+'</option>');
        });
        
        var select = '<div style="display:none;position: absolute; width: '+input.width()+'px; top: '+(parseFloat(input.outerHeight())+parseFloat(input.offset().top))+'px; left: '+input.offset().left+'px;" class="ac_results"><ul style="max-height: 180px; overflow: auto;">';
        var i=0;
        $('option',baseSelect).each(function(){
            select += '<li class="ac_'+(i++%2==0?'even':'odd')+'" val="'+this.value+'">'+this.innerHTML+'</li>';
        });        
        select += '</ul></div>';
        select= $(select);
        
        $('li',select).hover(
            function () {
                $(this).addClass("ac_over");
            },
            function () {
                $(this).removeClass("ac_over");
            }
            ).click(function(){
            input.val(this.innerHTML);
            input.attr('val',$(this).attr('val'));
            select.hide();
        });
        
        $('body').append(select);
        var expander = wraper.find('b');
        expander.click(function(){
            select.toggle();
        });
        input.focus(function(){
            expander.hide();
            select.remove();
        })
    });
}

