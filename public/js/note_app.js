var App = (function(){

    var maxRetries = 5;
    var retryInterval = 5;
    var retryCount = 0;
    var backgroundOptions = [];
    var typingTimers = {};
    var doneTypingInterval = 3;

    function init(){
        loadingOn();
        getNotes();
    }

    function getNotes(){

        $.ajax({
            url: "api/notes",
            method: "GET",
            success: function(data){
                retryCount = 0;

                addContainers();
                showNotes(data);
                loadingOff();
            },
            error: function(){
                if(retryCount < maxRetries){
                    setTimeout(getNotes, retryInterval * 1000);
                    retryCount ++;
                } else {
                    console.log("stop app");
                    loadingOff();
                }
            }            
        });
    }

    function loadingOn(){
        $("#app_loading").show();
    }

    function loadingOff(){
        $("#app_loading").hide();
    }

    function createNote(){

        loadingOn();

        $.ajax({
            url: "api/add/note",
            method: "POST",
            success: function(data){
                if(typeof data.id !== "undefined"){
                    addNote(data);
                } else {
                    alert("Failed to add note. Please try again.");    
                }
                loadingOff();
            },
            error: function(){
                loadingOff();
                alert("Failed to add note. Please try again.");
            }
            
        })
    }

    function getBackgroundColorById(bId){
        for(var i = 0; i < backgroundOptions.length; i++){
            if(backgroundOptions[i].id == bId){
                return backgroundOptions[i].b_content;
            }
        }

        return "#441fff";
    }

    function addNote(note){

        var $note = $(view_note(note));
        $note.appendTo(`#notes`);

        var $backgroundDrop = $(`#note_background_${note.id}`);
        var $area = $(`#note_text_${note.id}`);

        // set background
        var background = note.n_background == 0 ?
          getBackgroundColorById($backgroundDrop.val()) : getBackgroundColorById(note.n_background);

        $note.css("background", background);
        $backgroundDrop.css("background", background);

        $(`#del_note_${note.id}`).off("click").on("click", function(){
            callDeleteNote(note.id);
        });

        $backgroundDrop.on("change", function(){
            updateNote(note.id);
        });

        $area.on('keyup', function () {
            clearTimeout(typingTimers[`note_${note.id}`]);
            typingTimers[`note_${note.id}`] = setTimeout( function(){updateNote(note.id)}, doneTypingInterval * 1000);
        });

        $area.on('keydown', function () {
            clearTimeout(typingTimers[`note_${note.id}`]);
        });
    }

    function updateNote(id){
console.log("update");
        var text = $(`#note_text_${id}`).html();
        var background = $(`#note_background_${id}`).val();
        var color = $(`#note_background_${id} option:selected`).attr("data-background");

        $.ajax({
            url: `api/edit/note/${id}`,
            method: "POST",
            data: {text: text, background: background},
            success: function(data){
                $(`#note_${id}`).css("background", color);
                $(`#note_background_${id}`).css("background", color);
            },
            error: function(){
                console.log("failed to update note: " + id);
            }

        })
    }

    function callDeleteNote(id){

        loadingOn();

        $.ajax({
            url: `api/delete/note/${id}`,
            method: "DELETE",
            success: function(data){
                removeNote(data.id);
                loadingOff();
            },
            error: function(){
                loadingOff();
                alert("Failed to remove note. Please try again.");
            }
        });
    }

    function removeNote(id){
        $(`#note_${id}`).remove();
    }

    function addContainers(){
        $(`#note_app`).html(view_containers());
        $(`#add_note`).off("click").on("click", function(){
            createNote();
        })
    }

    function showNotes(data){

        backgroundOptions = data.background;

        for(var i = 0; i < data.notes.length; i++){
            addNote(data.notes[i]);
        }
    }

    function view_backgroundOptions(options, selected){

         var html = "";

         for(var i = 0; i < options.length; i++){
             var opt = options[i];
             var selectItem = opt.id == selected ? "selected" : "";
             html += `<option value="${opt.id}" data-background="${opt.b_content}" ${selectItem}>${opt.b_label}</option>`;
         }

         return html;
    }

    function view_note(data){

        return `<div class="pull-left clearfix note" id="note_${data.id}">
                    <div class="clearfix note_header">
                    <div class="pull-left note_background">
                        <select id="note_background_${data.id}">
                            ${view_backgroundOptions(backgroundOptions, data.n_background)}
                        </select>
                    </div>
                    <div class="pull-right note_delete" id="del_note_${data.id}">X</div>
                    </div>
                    <div class="note_body">
                        <div contenteditable="true" id="note_text_${data.id}">${data.n_text}</div>
                    </div>
                </div>`;
    }

    function view_containers(){
        return `<div class="app_container">
                    <div>
                        <button id="add_note">Add Note</button>
                    </div>
                    <div id="notes"></div>
                </div>`;
    }

    return {
        init: init
    }
})();