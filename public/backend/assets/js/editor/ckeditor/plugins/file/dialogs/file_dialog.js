CKEDITOR.dialog.add('file_dialog', function (editor) {
    return {
        title: 'Upload a file',
        minWidth: 400,
        minHeight: 200,
        contents: [
            {
                id: 'tab-basic',
                label: 'Basic Settings',
                elements: [
                    {
                        type: 'hbox',
                        widths: ['75%', '25%'],
                        children: [
                            {
                                type: 'file',
                                id: 'main_file',
                                label: 'File'
                            },
                            {
                                type: 'button',
                                id: 'browse',
                                // ...
                                label: editor.lang.common.browseServer,
                                filebrowser: {
                                    action: 'Browse',
                                    target: 'tab-basic:main_file_input',
                                    url: editor.config.filebrowserImageBrowseUrl
                                },
                            },
                        ]
                    },
                    {
                        type: 'text',
                        id: 'main_file_input',
                    },
                    {
                        type: 'text',
                        id: 'file_class',
                        label: 'Caption',
                    },
                ]
            },
        ],
        onOk: function () {
            var dialog = CKEDITOR.dialog.getCurrent();
            // console.log(dialog);
            var fd = new FormData();
            var formTab = document.querySelector('[name=tab-basic]');
            var iframe = formTab.querySelector('iframe');
            var file_class = dialog.getValueOf('tab-basic', 'file_class');
            var innerDoc = (iframe.contentDocument)
                ? iframe.contentDocument
                : iframe.contentWindow.document;
            if(CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "main_file").getInputElement().getValue()) {
                fd.append('file', CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "main_file").getInputElement().$.files[0]);
            }
            fd.append('file_input', CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "main_file_input").getValue());
            fd.append("_token", document.querySelector(['meta[name=csrf-token]']).getAttribute('content'));
            var xhr = new XMLHttpRequest();
            let url = '/backend/administration_panel_745282/files/upload_file';
            xhr.open('POST', url, true);
            xhr.addEventListener('load', function (e) {
                console.log(xhr.response);
                let response = JSON.parse(xhr.response);
                let element = CKEDITOR.dom.element.createFromHtml(`<a href="${response}" title="Link" class="tp-docs__list-item tp-docs__list-item--download">${file_class}</a>`);
                return editor.insertElement(element);

            });
            xhr.send(fd);
        },
        onLoad: function () {
            var dialog = CKEDITOR.dialog.getCurrent();
            dialog.getContentElement('tab-basic', 'main_file_input').disable();
        }
    };
});
