CKEDITOR.dialog.add('image_fancy', function (editor) {
    return {
        title: 'Upload Image',
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
                                id: 'fancy_image_file',
                                label: 'Image'
                            },
                            {
                                type: 'button',
                                id: 'browse',
                                // ...
                                label: editor.lang.common.browseServer,
                                filebrowser: {
                                    action: 'Browse',
                                    target: 'tab-basic:select_image_file_input',
                                    url: editor.config.filebrowserImageBrowseUrl
                                },
                            },
                        ]
                    },
                    {
                        type: 'text',
                        id: 'select_image_file_input',
                    },
                    {
                        type: 'hbox',
                        widths: ['75%', '25%'],
                        children: [
                            {
                                type: 'file',
                                id: 'fancy_image_preview',
                                label: 'Preview'
                            },
                            {
                                type: 'button',
                                id: 'browsePreview',
                                // ...
                                label: editor.lang.common.browseServer,
                                filebrowser: {
                                    action: 'Browse',
                                    target: 'tab-basic:select_image_preview_input',
                                    url: editor.config.filebrowserImageBrowseUrl
                                },
                            },
                        ]
                    },
                    {
                        type: 'text',
                        id: 'select_image_preview_input',
                    },
                    {
                        type: 'text',
                        id: 'caption_fancy',
                        label: 'Caption',
                    },
                    {
                        type: 'checkbox',
                        id: 'fancy_image_check',
                        label: 'Do not Crop',
                    },
                    {
                        type: 'checkbox',
                        id: 'only_image',
                        label: 'No FancyBox(Plain Image)',
                    },
                ]
            },
            {
                id: 'tab-adv',
                label: 'Advanced Settings',
                elements: [
                    // UI elements of the second tab will be defined here.
                ]
            }
        ],
        onOk: function () {
            var dialog = CKEDITOR.dialog.getCurrent();
            // console.log(dialog);
            var fd = new FormData();
            var formTab = document.querySelector('[name=tab-basic]');
            var iframe = formTab.querySelector('iframe')
            var crop = dialog.getValueOf('tab-basic', 'fancy_image_check');
            var only_image = dialog.getValueOf('tab-basic', 'only_image');
            var caption = dialog.getValueOf('tab-basic', 'caption_fancy');
            var select_image_preview_input = dialog.getValueOf('tab-basic', 'select_image_preview_input');
            var select_image_file_input = dialog.getValueOf('tab-basic', 'select_image_file_input');
            var file = CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "fancy_image_preview").getInputElement().$.files[0];
            var innerDoc = (iframe.contentDocument)
                ? iframe.contentDocument
                : iframe.contentWindow.document;
            if(CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "fancy_image_file").getInputElement().getValue()) {
                fd.append('file', CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "fancy_image_file").getInputElement().$.files[0]);
            }
            if ( CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "fancy_image_preview").getInputElement().getValue()) {
                fd.append('preview', CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "fancy_image_preview").getInputElement().$.files[0]);
            }
            fd.append('select_image_file_input', CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "select_image_file_input").getValue());
            fd.append('select_image_preview_input', CKEDITOR.dialog.getCurrent().getContentElement("tab-basic", "select_image_preview_input").getValue());
            fd.append("crop", crop ? '' : 'crop');
            fd.append("_token", document.querySelector(['meta[name=csrf-token]']).getAttribute('content'));
            var xhr = new XMLHttpRequest();
            let url = '/backend/a5t465grp/files/upload_fancy_image';
            if (only_image) {
                url = '/backend/a5t465grp/files/upload_image'
            }
            xhr.open('POST', url, true);
            xhr.addEventListener('load', function (e) {
                console.log(xhr.response);
                let response = JSON.parse(xhr.response);
                if (only_image) {
                    let element = CKEDITOR.dom.element.createFromHtml('<img alt="image" src="' + response + '">');
                    return editor.insertElement(element);
                }
                let element = CKEDITOR.dom.element.createFromHtml('<figure>\n' +
                    '                                    <a class="gallery" href="' + response.max + '" data-fancybox="gallery" data-caption="' + caption + '">\n' +
                        '                                            <img loading="lazy" src="' + response.min + '" height="700" alt="' + caption + '">\n' +
                        '                                <span class="over">\n' +
                        '                                    <svg xmlns="http://www.w3.org/2000/svg" width="62" height="62" viewBox="0 0 62 62" fill="none">\n' +
                        '                                        <path\n' +
                        '                                            d="M16.1458 11.625C14.9468 11.625 13.7969 12.1013 12.9491 12.9491C12.1013 13.7969 11.625 14.9468 11.625 16.1458V20.0208C11.625 20.5347 11.4209 21.0275 11.0575 21.3909C10.6942 21.7542 10.2014 21.9583 9.6875 21.9583C9.17364 21.9583 8.68083 21.7542 8.31748 21.3909C7.95413 21.0275 7.75 20.5347 7.75 20.0208V16.1458C7.75 13.9191 8.63456 11.7836 10.2091 10.2091C11.7836 8.63456 13.9191 7.75 16.1458 7.75H20.0208C20.5347 7.75 21.0275 7.95413 21.3909 8.31748C21.7542 8.68083 21.9583 9.17364 21.9583 9.6875C21.9583 10.2014 21.7542 10.6942 21.3909 11.0575C21.0275 11.4209 20.5347 11.625 20.0208 11.625H16.1458ZM45.8542 11.625C48.3497 11.625 50.375 13.6503 50.375 16.1458V20.0208C50.375 20.5347 50.5791 21.0275 50.9425 21.3909C51.3058 21.7542 51.7986 21.9583 52.3125 21.9583C52.8264 21.9583 53.3192 21.7542 53.6825 21.3909C54.0459 21.0275 54.25 20.5347 54.25 20.0208V16.1458C54.25 13.9191 53.3654 11.7836 51.7909 10.2091C50.2164 8.63456 48.0809 7.75 45.8542 7.75H41.9792C41.4653 7.75 40.9725 7.95413 40.6091 8.31748C40.2458 8.68083 40.0417 9.17364 40.0417 9.6875C40.0417 10.2014 40.2458 10.6942 40.6091 11.0575C40.9725 11.4209 41.4653 11.625 41.9792 11.625H45.8542ZM45.8542 50.375C47.0532 50.375 48.2031 49.8987 49.0509 49.0509C49.8987 48.2031 50.375 47.0532 50.375 45.8542V41.9792C50.375 41.4653 50.5791 40.9725 50.9425 40.6091C51.3058 40.2458 51.7986 40.0417 52.3125 40.0417C52.8264 40.0417 53.3192 40.2458 53.6825 40.6091C54.0459 40.9725 54.25 41.4653 54.25 41.9792V45.8542C54.25 48.0809 53.3654 50.2164 51.7909 51.7909C50.2164 53.3654 48.0809 54.25 45.8542 54.25H41.9792C41.4653 54.25 40.9725 54.0459 40.6091 53.6825C40.2458 53.3192 40.0417 52.8264 40.0417 52.3125C40.0417 51.7986 40.2458 51.3058 40.6091 50.9425C40.9725 50.5791 41.4653 50.375 41.9792 50.375H45.8542ZM16.1458 50.375C14.9468 50.375 13.7969 49.8987 12.9491 49.0509C12.1013 48.2031 11.625 47.0532 11.625 45.8542V41.9792C11.625 41.4653 11.4209 40.9725 11.0575 40.6091C10.6942 40.2458 10.2014 40.0417 9.6875 40.0417C9.17364 40.0417 8.68083 40.2458 8.31748 40.6091C7.95413 40.9725 7.75 41.4653 7.75 41.9792V45.8542C7.75 48.0809 8.63456 50.2164 10.2091 51.7909C11.7836 53.3654 13.9191 54.25 16.1458 54.25H20.0208C20.5347 54.25 21.0275 54.0459 21.3909 53.6825C21.7542 53.3192 21.9583 52.8264 21.9583 52.3125C21.9583 51.7986 21.7542 51.3058 21.3909 50.9425C21.0275 50.5791 20.5347 50.375 20.0208 50.375H16.1458Z"\n' +
                        '                                            fill="white" fill-opacity="0.8" />\n' +
                        '                                    </svg>\n' +
                        '                                </span>\n' +
                    '                                    </a>\n' +
                    '                                    <figcaption>' + caption + '</figcaption>\n' +
                    '                                </figure>');
                return editor.insertElement(element);

            });
            xhr.send(fd);
        },
        onLoad: function () {
            var dialog = CKEDITOR.dialog.getCurrent();
            dialog.getContentElement('tab-basic', 'select_image_file_input').disable();
            dialog.getContentElement('tab-basic', 'select_image_preview_input').disable();
        }
    };
});
