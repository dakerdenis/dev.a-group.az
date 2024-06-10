CKEDITOR.dialog.add('image_tour', function (editor) {
    return {
        title: 'Блок тура', minWidth: 400, minHeight: 200, contents: [{
            id: 'tab-basic', label: 'Basic Settings', elements: [{
                type: 'hbox', widths: ['75%', '25%'], children: [{
                    type: 'file', id: 'fancy_image_file_1', label: 'Изображение'
                }, {
                    type: 'button', id: 'browse_1', // ...
                    label: editor.lang.common.browseServer, filebrowser: {
                        action: 'Browse',
                        target: 'tab-basic:select_image_file_input_1',
                        url: editor.config.filebrowserImageBrowseUrl
                    },
                },]
            }, {
                type: 'text', id: 'select_image_file_input_1'
            }, {
                type: 'text', id: 'tour_text_1', label: 'Название'
            }, {
                type: 'text', id: 'tour_link_1', label: 'Ссылка'
            },{
                type: 'hbox', widths: ['75%', '25%'], children: [{
                    type: 'file', id: 'fancy_image_file_2', label: 'Изображение'
                }, {
                    type: 'button', id: 'browse_2', // ...
                    label: editor.lang.common.browseServer, filebrowser: {
                        action: 'Browse',
                        target: 'tab-basic:select_image_file_input_2',
                        url: editor.config.filebrowserImageBrowseUrl
                    },
                },]
            }, {
                type: 'text', id: 'select_image_file_input_2'
            }, {
                type: 'text', id: 'tour_text_2', label: 'Название'
            }, {
                type: 'text', id: 'tour_link_2', label: 'Ссылка'
            },{
                type: 'hbox', widths: ['75%', '25%'], children: [{
                    type: 'file', id: 'fancy_image_file_3', label: 'Изображение'
                }, {
                    type: 'button', id: 'browse_3', // ...
                    label: editor.lang.common.browseServer, filebrowser: {
                        action: 'Browse',
                        target: 'tab-basic:select_image_file_input_3',
                        url: editor.config.filebrowserImageBrowseUrl
                    },
                },]
            }, {
                type: 'text', id: 'select_image_file_input_3'
            }, {
                type: 'text', id: 'tour_text_3', label: 'Название'
            }, {
                type: 'text', id: 'tour_link_3', label: 'Ссылка'
            },]
        }], onOk: async function () {
            var dialog = CKEDITOR.dialog.getCurrent();
            var fd = new FormData();
            var formTab = document.querySelector('[name=tab-basic]');
            var iframe = formTab.querySelector('iframe')
            var innerDoc = (iframe.contentDocument) ? iframe.contentDocument : iframe.contentWindow.document;
            if (CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "fancy_image_file").getInputElement().getValue()) {
                fd.append('file', CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "fancy_image_file").getInputElement().$.files[0]);
            }
            fd.append('select_image_file_input', CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "select_image_file_input").getValue());
            fd.append("_token", document.querySelector(['meta[name=csrf-token]']).getAttribute('content'));
            var xhr = new XMLHttpRequest();
            let url = '/backend/14ati8/files/upload_tour'
            xhr.open('POST', url, true);
            var caption = dialog.getValueOf('tab-basic', 'tour_text') ?? '';
            var link = dialog.getValueOf('tab-basic', 'tour_link') ?? '';
            xhr.addEventListener('load', function (e) {
                let response = JSON.parse(xhr.response);
                let element = CKEDITOR.dom.element.createFromHtml('<div style="background-image: url(' + response + ')" class="state_tour_element">\n' + '                  <a href="' + link + '">\n' + caption + '                  </a>\n' + '                </div>');
                return editor.insertElement(element);

            });
            await xhr.send(fd);
            //TODO: Хотел сделать чтобы с формы все три тура отправлялись потом в цикле строился блок с ними
        }, onLoad: function () {
            var dialog = CKEDITOR.dialog.getCurrent();
            dialog.getContentElement('tab-basic', 'select_image_file_input_1').disable();
            dialog.getContentElement('tab-basic', 'select_image_file_input_2').disable();
            dialog.getContentElement('tab-basic', 'select_image_file_input_3').disable();
        }
    };
});
