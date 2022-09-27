$(document).ready(function() { 

    $("form").submit(function(e){
        e.preventDefault();
        $(this).find('button').click();
    });

    $('#calculate-string').click(function() {
        send_post('string', {sum: $('.string-sum').val()});
    })

    $('#calculate-table').click(function() {
        send_post('table', {
            cell1: $('#cell1').val(),
            cell2: $('#cell2').val(),
            cell3: $('#cell3').val(),
            cell4: $('#cell4').val(),
        });
    })

    $('.alert button').click(function() {
        closeAlert();
    })

    $('.delete-all').click(function() {
        $('.previous').html('');
        savePreviousAnswers()
    })

    if (localStorage.getItem("previousAnswers") !== null) {
        $('.previous').html(localStorage.getItem('previousAnswers'));

        setEventsOnAnswers();
    }

    if (localStorage.getItem("notes") !== null) {
        $('#notes').val(localStorage.getItem('notes'));    
    }

    $('#notes').change(function() {
        saveNotes();
    })

});

function send_post(requestType, postDataObject) {
    $.post("api/", { type: requestType, ...postDataObject })
     .done(function( data ) {
        let response = JSON.parse(data);

        console.log(data, response);

        if (response.status == 'error') {
            showAlert('warning', response.message);
            return;
        }

        showAlert('success', 'Som succesvol berekend');

        if (requestType == 'string') {
            addPreviousAnswer(postDataObject.sum, response.message);
        } else if (requestType == 'table') {
            addPreviousAnswer('Tabel berekening', response.message);
        }
    });
}

function showAlert(type, message) {
    $('.alert').attr('class', `alert alert-${type}`).show().children('p').text(message);
}

function closeAlert() {
    $('.alert').hide();
}

function addPreviousAnswer(sum, result) {

    $('.previous').append(            
    $(`<li>
        <span class="text-secondary me-2">${sum}</span>
        <span> = </span>
        <span class="fw-bold me-2">${result}</span>
        <button class="delete text-danger bg-light border-0"><i class="fa-solid fa-trash-can"></i></button>
    </li>`)
    );

    setEventsOnAnswers()

    savePreviousAnswers();
}

function savePreviousAnswers() {
    localStorage.setItem('previousAnswers', $('.previous').html());
}

function saveNotes() {
    localStorage.setItem('notes', $('#notes').val());
}

function setEventsOnAnswers() {
    $('li .delete').click(function() {
        $(this).parent().remove();
        savePreviousAnswers()
    })

    $('li span').click(function() {
        navigator.clipboard.writeText($(this).html());
        let span = $(this);
        span.addClass('copied');
        setTimeout(function() {
            span.removeClass('copied'); 
        }, 250)
    })
}