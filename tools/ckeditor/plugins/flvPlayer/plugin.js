
CKEDITOR.plugins.add('flvPlayer', {
    requires: ['dialog', 'fakeobjects'],
    lang: ['en'],
    init: function(editor) {
        var cmdName = 'flvPlayer';
        var cmd = editor.addCommand(cmdName, new CKEDITOR.dialogCommand(cmdName));
        cmd.modes = {wysiwyg: 1, source: 0};
        cmd.canUndo = false;

        editor.ui.addButton('flvPlayer', {
            label: editor.lang.flvPlayer.btnLabel,
            icon: this.path + 'images/btn_icon.gif',
            command: cmdName
        });
        CKEDITOR.dialog.add(cmdName, this.path + 'dialogs/flvPlayer.js');
    }
});
CKEDITOR.tools.extend(CKEDITOR.config, {
    flvPlayer: {              
              movie: '/tools/ckeditor/plugins/flvPlayer/flowplayer-3.2.11.swf',
              extraFlashVars: '',                            
              width : 600,
              height : 480                            
              
    }
});

