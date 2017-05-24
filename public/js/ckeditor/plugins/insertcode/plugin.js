CKEDITOR.plugins.add('insertcode',
    {
        init: function(editor)
        {
//plugin code goes here
            var pluginName = 'insertcode';
            CKEDITOR.dialog.add(pluginName, this.path + 'insertcode.js');
            editor.config.flv_path = editor.config.flv_path || (this.path);
            editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));
            editor.ui.addButton('insertcode',
                {
                    label: '插入代码',
                    command: pluginName,
                    icon: this.path + 'insertcode.png'
                });
        }
    });