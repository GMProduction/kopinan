function toFixedIfNecessary( value, dp = 2 ){
    return +parseFloat(value).toFixed( dp );
}

async function saveData(title, form, url, resposeSuccess, image = null) {

    var form_data = new FormData($('#' + form)[0]);

    swal({
        title: title,
        text: "Apa kamu yakin ?",
        icon: "info",
        buttons: true,
        primariMode: true,
    })
        .then(async (res) => {
            if (res) {
                if (image) {
                    if ($('#' + image).val()) {
                        let image1 = await handleImageUpload($('#' + image));
                        form_data.append('profile', image1, image1.name);
                    }
                }
                $.ajax({
                    type: "POST",
                    data: form_data,
                    url: url ?? window.location.pathname,
                    async: true,
                    processData: false,
                    contentType: false,
                    headers: {
                        'Accept': "application/json"
                    },
                    success: function (data, textStatus, xhr) {
                        console.log(data);

                        if (xhr.status === 200) {
                            swal("Berhasil", {
                                icon: "success",
                                buttons: false,
                                timer: 1000
                            }).then((dat) => {
                                if (resposeSuccess) {
                                    resposeSuccess(data)
                                } else {
                                    window.location.reload()
                                }
                            });
                        } else {
                            swal(data['msg'])
                        }
                        console.log(data);
                    },
                    xhr: function () {
                        $('#progressbar').remove();
                        $('#' + form).append(' <div id="progressbar" class="progress mt-2">\n' +
                            '                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                            '                            </div>')
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                //Do something with upload progress here
                                // console.log(percentComplete)
                                $('#progressbar div').attr('style', "width:" + percentComplete + '%').html(parseInt(percentComplete) + '%')
                                if (percentComplete === 100) {
                                    $('#progressbar div').addClass('bg-success')
                                }
                            }
                        }, false);
                        return xhr;
                    },
                    // uploadProgress: function(event, position, total, percentComplete){
                    //     var percentVal = percentComplete + '%';
                    //     console.log(percentVal);
                    //     console.log(percentVal);
                    //
                    // },
                    complete: function (xhr, textStatus) {
                        $('#progressbar').remove();
                    },
                    error: function (error, xhr, textStatus) {
                        // console.log("LOG ERROR", error.responseJSON.errors);
                        // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                        $('#progressbar div').removeClass('bg-success').addClass('bg-danger');
                        console.log(error);
                        console.log(textStatus);
                        swal(JSON.parse(error.responseText).errors ? JSON.parse(error.responseText).errors[Object.keys(JSON.parse(error.responseText).errors)[0]][0] : JSON.parse(error.responseText)?.message ? JSON.parse(error.responseText).message : JSON.parse(error.responseText).msg ? JSON.parse(error.responseText).msg : error.responseJSON['msg'])
                        // swal(error.responseText ? JSON.parse(error.responseText).message : error.responseJSON['msg'] )
                    }
                })
            }
        });
    return false;
}

function saveDataObjectFormData(title, form, url, resposeSuccess, method = 'POST') {
    console.log('formform',typeof form)
    let form_data = $('#'+form).serialize();
    console.log('form',form_data)

    alertify.confirm('', function () {
        $.ajax({
            type: method,
            data: form_data,
            url: url ?? window.location.pathname,
            async: true,
            // processData: false,
            // contentType: false,
            headers: {
                'Accept': "application/json"
            },
            success: function (data, textStatus, xhr) {

                if (xhr.status === 200) {
                    swal(data?.msg ?? "Berhasil", {
                        icon: "success",
                        buttons: false,
                        timer: 1500
                    }).then((dat) => {
                        if (resposeSuccess) {
                            resposeSuccess(data)
                        } else {
                            window.location.reload()
                        }
                    });
                } else {
                    swal(data['msg'])
                }
                $('#'+form+' button').removeAttr('disabled')

            },
            xhr: function () {
                $('#'+form).append(' <div id="progressbar" class="progress mt-2">\n' +
                    '                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                    '                            </div>')
                $('#'+form+' button').attr('disabled', '')
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        //Do something with upload progress here
                        console.log(evt.loaded)
                        console.log(evt.total)
                        console.log(percentComplete)
                        $('#progressbar div').attr('style', "width:" + percentComplete + '%').html(parseInt(percentComplete) + '%')
                        if (percentComplete === 100) {
                            console.log('close loadning 100')
                            $('#loading').modal('hide')
                            $('#progressbar div').addClass('bg-success')
                        }
                    }
                }, false);
                return xhr;
            },
            complete: function (xhr, textStatus) {
                $('#progressbar').remove();
                // $('#form button').removeAttr('disabled')

            },
            error: function (error, xhr, textStatus) {
                $('#'+form+' button').removeAttr('disabled')
                $('#progressbar').remove();
                // console.log("LOG ERROR", error.responseJSON.errors);
                // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                console.log(xhr.status);
                console.log(textStatus);
                console.log(error.responseJSON);
                swal(JSON.parse(error.responseText).errors ? JSON.parse(error.responseText).errors[Object.keys(JSON.parse(error.responseText).errors)[0]][0] : JSON.parse(error.responseText)?.message ? JSON.parse(error.responseText).message : error.responseJSON?.msg ?? textStatus)

                // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )

            }
        })
    }, function () {

    }).setHeader(title).setContent('<div id="confirmDialog" class="w-full d-flex flex-column align-items-center"><p>Apakah Anda Yakin ' + title + ' ?</p></div>').set('movable', false).set('defaultFocusOff', false).set('labels', {
        cancel: 'Batalkan',
        ok: 'Simpan',
    }).set('reverseButtons', true).show();

    return false;
}

function saveDataAjax(title, form_data,  url, resposeSuccess,form = '', method = 'POST') {

    alertify.confirm('', function () {
        $.ajax({
            type: method,
            data: form_data,
            url: url ?? window.location.pathname,
            async: true,
            // processData: false,
            // contentType: false,
            headers: {
                'Accept': "application/json"
            },
            success: function (data, textStatus, xhr) {

                if (xhr.status === 200) {
                    swal(data?.msg ?? "Berhasil", {
                        icon: "success",
                        buttons: false,
                        timer: 1500
                    }).then((dat) => {
                        if (resposeSuccess) {
                            resposeSuccess(data)
                        } else {
                            window.location.reload()
                        }
                    });
                } else {
                    swal(data['msg'])
                }
                $('#'+form+' button').removeAttr('disabled')

            },
            xhr: function () {
                $('#'+form).append(' <div id="progressbar" class="progress mt-2">\n' +
                    '                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                    '                            </div>')
                $('#'+form+' button').attr('disabled', '')
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        //Do something with upload progress here
                        console.log(evt.loaded)
                        console.log(evt.total)
                        console.log(percentComplete)
                        $('#progressbar div').attr('style', "width:" + percentComplete + '%').html(parseInt(percentComplete) + '%')
                        if (percentComplete === 100) {
                            console.log('close loadning 100')
                            $('#loading').modal('hide')
                            $('#progressbar div').addClass('bg-success')
                        }
                    }
                }, false);
                return xhr;
            },
            complete: function (xhr, textStatus) {
                $('#progressbar').remove();
                // $('#form button').removeAttr('disabled')

            },
            error: function (error, xhr, textStatus) {
                $('#'+form+' button').removeAttr('disabled')
                $('#progressbar').remove();
                // console.log("LOG ERROR", error.responseJSON.errors);
                // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                console.log(xhr.status);
                console.log(textStatus);
                console.log(error.responseJSON);
                swal(JSON.parse(error.responseText).errors ? JSON.parse(error.responseText).errors[Object.keys(JSON.parse(error.responseText).errors)[0]][0] : JSON.parse(error.responseText)?.message ? JSON.parse(error.responseText).message : error.responseJSON?.msg ?? textStatus)

                // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )

            }
        })
    }, function () {

    }).setHeader(title).setContent('<div id="confirmDialog" class="w-full d-flex flex-column align-items-center"><p>Apakah Anda Yakin ' + title + ' ?</p></div>').set('movable', false).set('defaultFocusOff', false).set('labels', {
        cancel: 'Batalkan',
        ok: 'Simpan',
    }).set('reverseButtons', true).show();

    return false;
}


function saveDataObjectFormDataOver(title, form_data,form, url, resposeSuccess, method = 'POST') {
    alertify.confirm('', function () {
        $.ajax({
            type: method,
            data: form_data,
            url: url ?? window.location.pathname,
            async: true,
            // processData: false,
            // contentType: false,
            headers: {
                'Accept': "application/json"
            },
            success: function (data, textStatus, xhr) {

                if (xhr.status === 200) {
                    swal(data?.msg ?? "Berhasil", {
                        icon: "success",
                        buttons: false,
                        timer: 1500
                    }).then((dat) => {
                        if (resposeSuccess) {
                            resposeSuccess(data)
                        } else {
                            window.location.reload()
                        }
                    });
                } else {
                    swal(data['msg'])
                }
                $('#'+form+' button').removeAttr('disabled')

            },
            xhr: function () {
                $('#'+form).append(' <div id="progressbar" class="progress mt-2">\n' +
                    '                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                    '                            </div>')
                $('#'+form+' button').attr('disabled', '')
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        //Do something with upload progress here
                        console.log(evt.loaded)
                        console.log(evt.total)
                        console.log(percentComplete)
                        $('#progressbar div').attr('style', "width:" + percentComplete + '%').html(parseInt(percentComplete) + '%')
                        if (percentComplete === 100) {
                            console.log('close loadning 100')
                            $('#loading').modal('hide')
                            $('#progressbar div').addClass('bg-success')
                        }
                    }
                }, false);
                return xhr;
            },
            complete: function (xhr, textStatus) {
                $('#progressbar').remove();
                // $('#form button').removeAttr('disabled')

            },
            error: function (error, xhr, textStatus) {
                $('#'+form+' button').removeAttr('disabled')
                $('#progressbar').remove();
                // console.log("LOG ERROR", error.responseJSON.errors);
                // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                console.log(xhr.status);
                console.log(textStatus);
                console.log(error.responseJSON);
                swal(JSON.parse(error.responseText).errors ? JSON.parse(error.responseText).errors[Object.keys(JSON.parse(error.responseText).errors)[0]][0] : JSON.parse(error.responseText)?.message ? JSON.parse(error.responseText).message : error.responseJSON?.msg ?? textStatus)

                // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )

            }
        })
    }, function () {

    }).setHeader(title).setContent('<div id="confirmDialog" class="w-full d-flex flex-column align-items-center"><img src="/assets/images/ask.svg" class="mb-3"/><p>Apakah Anda Yakin ' + title + ' ?</p></div>').set('movable', false).set('defaultFocusOff', false).set('labels', {
        cancel: 'Batalkan',
        ok: 'Simpan',
    }).set('reverseButtons', true).show();

    return false;
}

function saveFormData(title, form_data, url, resposeSuccess) {
    alertify.confirm('', function () {
        $.ajax({
            type: "POST",
            data: form_data,
            url: url ?? window.location.pathname,
            async: true,
            processData: false,
            contentType: false,
            headers: {
                'Accept': "application/json"
            },
            success: function (data, textStatus, xhr) {

                if (xhr.status === 200) {
                    swal(data?.msg ?? "Berhasil ", {
                        icon: "success",
                        buttons: false,
                        timer: 1500
                    }).then((dat) => {
                        if (resposeSuccess) {
                            resposeSuccess(data)
                        } else {
                            window.location.reload()
                        }
                    });
                } else {
                    swal(data['msg'])
                }
                $('#form button').removeAttr('disabled')

            },
            xhr: function () {
                $('#form').append(' <div id="progressbar" class="progress mt-2">\n' +
                    '                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                    '                            </div>')
                $('#form button').attr('disabled', '')
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        //Do something with upload progress here
                        console.log(evt.loaded)
                        console.log(evt.total)
                        console.log(percentComplete)
                        $('#progressbar div').attr('style', "width:" + percentComplete + '%').html(parseInt(percentComplete) + '%')
                        if (percentComplete === 100) {
                            console.log('close loadning 100')
                            $('#loading').modal('hide')
                            $('#progressbar div').addClass('bg-success')
                        }
                    }
                }, false);
                return xhr;
            },
            complete: function (xhr, textStatus) {
                $('#progressbar').remove();
                // $('#form button').removeAttr('disabled')

            },
            error: function (error, xhr, textStatus) {
                $('#form button').removeAttr('disabled')
                $('#progressbar').remove();
                // console.log("LOG ERROR", error.responseJSON.errors);
                // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                console.log(xhr.status);
                console.log(textStatus);
                console.log(error.responseJSON);
                swal(JSON.parse(error.responseText).errors ? JSON.parse(error.responseText).errors[Object.keys(JSON.parse(error.responseText).errors)[0]][0] : JSON.parse(error.responseText)?.message ? JSON.parse(error.responseText).message : error.responseJSON?.msg ?? textStatus)

                // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )

            }
        })
    }, function () {

    }).setHeader(title).setContent('<div id="confirmDialog" class="w-full d-flex flex-column align-items-center"><img src="/assets/images/ask.svg" class="mb-3"/><p>Apakah Anda Yakin ' + title + ' ?</p></div>').set('movable', false).set('defaultFocusOff', false).set('labels', {
        cancel: 'Batalkan',
        ok: 'Simpan',
    }).set('reverseButtons', true).show();

    return false;
}


function uploadFormData(title, form_data, url, resposeSuccess, form) {
    alertify.confirm('', function () {
        $.ajax({
            type: "POST",
            data: form_data,
            url: url ?? window.location.pathname,
            async: true,
            processData: false,
            contentType: false,
            headers: {
                'Accept': "application/json"
            },
            success: function (data, textStatus, xhr) {

                if (xhr.status === 200) {
                    swal(data?.msg ?? "Berhasil ", {
                        icon: "success",
                        buttons: false,
                        timer: 1500
                    }).then((dat) => {
                        if (resposeSuccess) {
                            resposeSuccess(data)
                        } else {
                            window.location.reload()
                        }
                    });
                } else {
                    swal(data['msg'])
                }
                $('#form button').removeAttr('disabled')

            },
            xhr: function () {
                $('#form').append(' <div id="progressbar" class="progress mt-2">\n' +
                    '                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                    '                            </div>')
                $('#form button').attr('disabled', '')
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        //Do something with upload progress here
                        console.log(evt.loaded)
                        console.log(evt.total)
                        console.log(percentComplete)
                        $('#progressbar div').attr('style', "width:" + percentComplete + '%').html(parseInt(percentComplete) + '%')
                        if (percentComplete === 100) {
                            console.log('close loadning 100')
                            $('#loading').modal('hide')
                            $('#progressbar div').addClass('bg-success')
                        }
                    }
                }, false);
                return xhr;
            },
            complete: function (xhr, textStatus) {
                $('#progressbar').remove();
                // $('#form button').removeAttr('disabled')
                form[0].reset();
            },
            error: function (error, xhr, textStatus) {
                $('#form button').removeAttr('disabled')
                $('#progressbar').remove();
                // console.log("LOG ERROR", error.responseJSON.errors);
                // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                console.log(xhr.status);
                console.log(textStatus);
                console.log(error.responseJSON);
                swal(JSON.parse(error.responseText).errors ? JSON.parse(error.responseText).errors[Object.keys(JSON.parse(error.responseText).errors)[0]][0] : JSON.parse(error.responseText)?.message ? JSON.parse(error.responseText).message : error.responseJSON?.msg ?? textStatus)

                // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )

            }
        })
    }, function () {

    }).setHeader(title).setContent('<div id="confirmDialog" class="w-full d-flex flex-column align-items-center"><img src="/assets/images/ask.svg" class="mb-3"/><p>Apakah Anda Yakin ' + title + ' ?</p></div>').set('movable', false).set('defaultFocusOff', false).set('labels', {
        cancel: 'Batalkan',
        ok: 'Simpan',
    }).set('reverseButtons', true).show();

    return false;
}

function saveDataAjaxWImage(title, form, form_data, url, resposeSuccess) {
    var dataForm = form_data['form_data'];
    console.log(form_data);
    // if (form_data['image']) {
    //     $.each(form_data['image'], async function (k, v) {
    //         if ($('#' + form + ' #' + v).val()) {
    //             let icon = await handleImageUpload($('#' + v));
    //             dataForm.append(v, icon, icon.name);
    //         }
    //     })
    // }
    console.log(dataForm);
    alertify.confirm('', function () {
        $.ajax({
            type: "POST",
            data: dataForm,
            url: url ?? window.location.pathname,
            async: true,
            processData: false,
            contentType: false,
            headers: {
                'Accept': "application/json"
            },
            success: function (data, textStatus, xhr) {

                if (xhr.status === 200) {
                    swal(data?.msg ?? "Data created ", {
                        icon: "success",
                        buttons: false,
                        timer: 1500
                    }).then((dat) => {
                        if (resposeSuccess) {
                            resposeSuccess(data)
                        } else {
                            window.location.reload()
                        }
                    });
                } else {
                    swal(data['msg'])
                    $('#form button').removeAttr('disabled')
                }
            },
            xhr: function () {
                $('#form').append(' <div id="progressbar" class="progress mt-2">\n' +
                    '                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                    '                            </div>')
                $('#form button').attr('disabled', '')
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        //Do something with upload progress here
                        console.log(evt.loaded)
                        console.log(evt.total)
                        console.log(percentComplete)
                        $('#progressbar div').attr('style', "width:" + percentComplete + '%').html(parseInt(percentComplete) + '%')
                        if (percentComplete === 100) {
                            console.log('close loadning 100')
                            $('#loading').modal('hide')
                            $('#progressbar div').addClass('bg-success')
                        }
                    }
                }, false);
                return xhr;
            },
            complete: function (xhr, textStatus) {
                $('#progressbar').remove();
                $('#form button').removeAttr('disabled')

            },
            error: function (error, xhr, textStatus) {
                $('#form button').removeAttr('disabled')
                $('#progressbar').remove();
                // console.log("LOG ERROR", error.responseJSON.errors);
                // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                console.log(xhr.status);
                console.log(textStatus);
                console.log(error.responseJSON);
                swal(JSON.parse(error.responseText).errors ? JSON.parse(error.responseText).errors[Object.keys(JSON.parse(error.responseText).errors)[0]][0] : JSON.parse(error.responseText)?.message ? JSON.parse(error.responseText).message : error.responseJSON?.msg ?? textStatus)

                // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )

            }
        })
    }, function () {

    }).setHeader(title).setContent('<div id="confirmDialog" class="w-full d-flex flex-column align-items-center"><p>Apakah Anda Yakin ' + title + ' ?</p></div>').set('movable', false).set('defaultFocusOff', false).set('labels', {
        cancel: 'Batalkan',
        ok: 'Simpan',
    }).set('reverseButtons', true).show();

    return false;

}

function alerty() {
    alertify.confirm('').setHeader('sadasasdasda').setContent('<div class="w-full d-flex flex-column align-items-center"><img src="../assets/images/ask.svg" class="mb-3"/><p>Apakah Anda yakin </p></div>').set('movable', false).set('defaultFocusOff', false).set('labels', {
        cancel: 'Tidak',
        ok: 'Ya',
    }).show();
    // alertify.confirm('asd').setContent('<div class="h-full w-full"><h5>asdasdadsk djasjdklasldjaskjdashdklah</h5></div>').set('frameless', true);

}

function postdeleteData(text, url, data, resposeSuccess) {
    console.log('asdasd', data)
    alertify.confirm('', function () {
        $.ajax({
            type: "POST",
            data: data,
            url: url,
            async: true,
            // processData: false,
            // contentType: false,
            headers: {
                'Accept': "application/json"
            },
            success: function (data, textStatus, xhr) {
                console.log('1111111111',data);

                if (xhr.status === 200) {
                    swal("Berhasil", {
                        icon: "success",
                        buttons: false,
                        timer: 1000
                    }).then((dat) => {
                        if (resposeSuccess) {
                            resposeSuccess(data)
                        } else {
                            window.location.reload()
                        }
                    });
                } else {
                    swal(data['msg'])
                }
                console.log(data);
            },
            complete: function (xhr, textStatus) {
                console.log(xhr.status);
                console.log(textStatus);
            },
            error: function (error, xhr, textStatus) {
                // console.log("LOG ERROR", error.responseJSON.errors);
                // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                // console.log(xhr.status);
                // console.log(textStatus);
                // console.log(error.responseJSON);
                // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )
                console.log();
                console.log(xhr);
                console.log(textStatus);
                // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )
                swal(error.responseText ? JSON.parse(error.responseText).message : error.responseJSON['msg'])
            }
        })
    }, function () {
    }).setHeader('Hapus Data').setContent('<div class="w-full d-flex flex-column align-items-center"><img src="/assets/images/ask.svg" class="mb-3"/><label>Apa kamu yakin menghapus data ' + text + ' ?</label></div>').set('movable', false).set('defaultFocusOff', false).set('labels', {
        cancel: 'Batalkan',
        ok: 'Hapus',
    }).set('reverseButtons', true).show();

    // swal({
    //     title: 'Hapus Data',
    //     text: "Apa kamu yakin menghapus data " + text + " ?",
    //     // icon: "info",
    //     imageUrl: "/assets/image/logo.svg",
    //     buttons: true,
    //     dangerMode: true,
    // })
    //     .then((res) => {
    //         if (res) {
    //             $.ajax({
    //                 type: "POST",
    //                 data: data,
    //                 url: url,
    //                 async: true,
    //                 // processData: false,
    //                 // contentType: false,
    //                 headers: {
    //                     'Accept': "application/json"
    //                 },
    //                 success: function (data, textStatus, xhr) {
    //                     console.log(data);
    //
    //                     if (xhr.status === 200) {
    //                         swal("Data Deleted ", {
    //                             icon: "success",
    //                             buttons: false,
    //                             timer: 1000
    //                         }).then((dat) => {
    //                             if (resposeSuccess) {
    //                                 resposeSuccess(data)
    //                             } else {
    //                                 window.location.reload()
    //                             }
    //                         });
    //                     } else {
    //                         swal(data['msg'])
    //                     }
    //                     console.log(data);
    //                 },
    //                 complete: function (xhr, textStatus) {
    //                     console.log(xhr.status);
    //                     console.log(textStatus);
    //                 },
    //                 error: function (error, xhr, textStatus) {
    //                     // console.log("LOG ERROR", error.responseJSON.errors);
    //                     // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
    //                     // console.log(xhr.status);
    //                     // console.log(textStatus);
    //                     // console.log(error.responseJSON);
    //                     // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )
    //                     console.log();
    //                     console.log(xhr);
    //                     console.log(textStatus);
    //                     // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )
    //                     swal(error.responseText ? JSON.parse(error.responseText).message : error.responseJSON['msg'] )
    //                 }
    //             })
    //         }
    //     });
    return false;
}

async function getSelect(id, url, nameValue = 'name', idValue, text = null,parent ) {
    var select = $('#' + id);
    select.empty();
    if (text) {
        select.append('<option value="" selected>' + text + '</option>')
    } else {
        select.append('<option value="" disabled selected>Pilih Data</option>')
    }
    await $.get(url, function (data) {
        $.each(data, function (key, value) {
            let val = value['value'] ?? '';
            if (idValue == value['id']) {
                select.append('<option value="' + value['id'] + '" data-value="' + val.toString() + '" selected>' + value[nameValue] + '</option>')
            } else {
                select.append('<option value="' + value['id'] + '" data-value="' + val.toString() + '">' + value[nameValue] + '</option>')
            }
        })
    })
    select.select2({
        dropdownParent: parent
    })
}

async function getSelectMultiple(id, url, nameValue = 'name', idValue, text = null, count = null) {
    var select = $('#' + id);
    select.empty();
    if (text) {
        select.append('<option value="" selected>' + text + '</option>')
    } else {
        select.append('<option value="" disabled selected>Pilih Data</option>')
    }
    await $.get(url, function (data) {
        if (count){
            $(count).html(data.length)
        }
        $.each(data, function (key, value) {
            let val = value['value'] ?? '';
            if (idValue == value['id']) {
                select.append('<option value="' + value['id'] + '"  selected>' + value[nameValue] + '</option>')
            } else {
                select.append('<option value="' + value['id'] + '" >' + value[nameValue] + '</option>')
            }
        })
    })
}

async function getSelectName(id, url, nameValue = 'name', idValue, text = null) {
    var select = $('#' + id);
    select.empty();
    if (text) {
        select.append('<option value="no" selected>' + text + '</option>')
    } else {
        select.append('<option value="" disabled selected>Pilih Data</option>')
    }
    await $.get(url, function (data) {
        $.each(data, function (key, value) {
            let val = value['value'] ?? '';
            if (idValue == value[nameValue]) {
                select.append('<option value="' + value['name'] + '" data-value="' + value['id'] + '" selected>' + value[nameValue] + '</option>')
            } else {
                select.append('<option value="' + value['name'] + '" data-value="' + value['id'] + '">' + value[nameValue] + '</option>')
            }
        })
    })
    select.select2()
}

function formatSelect2(opt) {
    if (!opt.id) {
        return opt.text;
    }

    var value = $(opt.element).attr('data-value');

    // return $('<span data>'+opt.text+'</span>')
}

// function currency(field) {
//     $('#' + field).on({
//         keyup: function () {
//             formatCurrency($(this));
//         },
//         blur: function () {
//             formatCurrency($(this), "blur");
//         }
//     });
// }

function setImgDropify(img, text = 'Masukkan Image Item', file = null, height = 400) {
    img = $('#' + img).dropify({
        messages: {
            'default': text,
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
    img = img.data('dropify');
    img.resetPreview();
    img.clearElement();

    if (file) {
        img.settings.defaultFile = file;
        img.destroy();
        img.init();
    }
    $('.dropify-wrapper').height(height).width(300);

}

function currency(field) {
    $('#' + field).on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        }
    });

}

function currencyClass(field) {
    $('.' + field).on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        }
    });

}


async function featchData(url) {
    let res = await $.get(url);
    return res;
}

$('#period').datepicker({
    format: 'MM yyyy',
    dateFormat: 'yyyy-MM-dd',
    viewMode: 'months',
    minViewMode: 'months',
    locale: 'id',
    autoclose: true,
    endDate: '+0d',
    language: "id"
}).on('changeDate', function (selected) {
});

$('.period').datepicker({
    format: "MM yyyy",
    endDate: "+0d",
    minViewMode: 1,
    language: "id",
    autoclose: true,
});


$('#periodYear, .periodYear').datepicker({
    format: 'yyyy',
    // dateFormat: 'yyyy-MM-dd',
    minViewMode: 2,
    locale: 'id',
    autoclose: true,
    endDate: '+0d',
    language: "id"
}).on('changeDate', function (selected) {
});

