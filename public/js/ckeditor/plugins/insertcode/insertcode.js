CKEDITOR.dialog.add('insertcode', function(editor){
    var escape = function(value){return value;};
    return{
        title: '插入代码',
        resizable: CKEDITOR.DIALOG_RESIZE_BOTH,
        minWidth: 720,
        minHeight: 520,
        contents: [{
            id: 'cb',
            name: 'cb',
            label: 'cb',
            title: 'cb',
            elements: [{
                type: 'select',
                label: 'Language',
                id: 'lang',
                required: true,
                'default': 'php',
                items: [
                    ['Bash/shell', 'bash'], 
                    ['C++', 'cpp'], 
                    ['CSS', 'css'], 
                    ['Delphi', 'delphi'], 
                    ['Diff', 'diff'], 
                    ['JavaScript', 'js'], 
                    ['Java', 'java'], 
                    ['Perl', 'perl'], 
                    ['PHP', 'php'], 
                    ['PowerShell', 'ps'], 
                    ['Python', 'py'], 
                    ['Ruby', 'rails'], 
                    ['Scala', 'scala'], 
                    ['SQL', 'sql'], 
                    ['XML', 'xml']]
            }, {
                type: 'textarea',
                style: 'width:718px;height:450px',
                label: 'Code',
                id: 'code',
                rows: 31,
                'default': ''
            }]
        }],
        onOk: function(){

            code = this.getValueOf('cb', 'code');
            lang = this.getValueOf('cb', 'lang');
            html = '' + escape(code) + '';
            // editor.insertHtml("<pre class=\"brush:" + lang + ";\">" + html + "</pre>");
            var _tpl = "<pre class=\"brush:" + lang + ";\">" + html + "</pre>";

            editor.insertHtml(_tpl,"unfiltered_html");
            // 
        },
        onLoad: function(){}
    };
});