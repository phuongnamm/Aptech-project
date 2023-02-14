$(document).ready(function () {
    // đồng hồ thời gian thực
    // function showTime() {
    //     let time = new Date();
    //     let hour = time.getHours();
    //     let min = time.getMinutes();
    //     let sec = time.getSeconds();
    //     am_pm = "AM";

    //     // xác định am / pm
    //     if (hour > 12) {
    //         hour -= 12;
    //         am_pm = "PM";
    //     }
    //     if (hour == 0) {
    //         hr = 12;
    //         am_pm = "AM";
    //     }

    //     hour = hour < 10 ? "0" + hour : hour;
    //     min = min < 10 ? "0" + min : min;
    //     sec = sec < 10 ? "0" + sec : sec;

    //     let currentTime = hour + " : " + min + " : " + sec + " " + am_pm;

    //     document.querySelector("#now-clock").innerHTML = currentTime;
    // }
    // setInterval(showTime, 1000);

    // showTime();

    // chart js 1
    new Chart('myChart1', {
        type: 'bar',
        data: {
            labels: ['Month-1', 'Month-2', 'Month-3', 'Month-4', 'Month-5', 'Month-6', 'Month-7', 'Month-8', 'Month-9', 'Month-10', 'Month-11', 'Month-12'],
            datasets: [{
                label: 'Tour Traffic Month',
                data: [72,
                    67,
                     9,
                     5,
                    28,
                    20,
                    66,
                    69,
                    93,
                    12,
                    49,
                    17],
                backgroundColor: [
                    'rgb(62, 142, 172, 0.2)',
                    'rgb(146, 13, 122, 0.2)',
                    'rgb(159, 220, 213, 0.2)',
                    'rgb(80, 188, 116, 0.2)',
                    'rgb(121, 164, 200, 0.2)',
                    'rgb(124, 11, 71, 0.2)',
                    'rgb(225, 79, 109, 0.2)',
                    'rgb(30, 104, 243, 0.2)',
                    'rgb(81, 151, 72, 0.2)',
                    'rgb(172, 162, 35, 0.2)',
                    'rgb(89, 32, 99, 0.2)',
                    'rgb(37, 82, 28, 0.2)'
                ],
                borderColor: [
                    'rgb(62, 142, 172, 1)',
                    'rgb(146, 13, 122, 1)',
                    'rgb(159, 220, 213, 1)',
                    'rgb(80, 188, 116, 1)',
                    'rgb(121, 164, 200, 1)',
                    'rgb(124, 11, 71, 1)',
                    'rgb(225, 79, 109, 1)',
                    'rgb(30, 104, 243, 1)',
                    'rgb(81, 151, 72, 1)',
                    'rgb(172, 162, 35, 1)',
                    'rgb(89, 32, 99, 1)',
                    'rgb(37, 82, 28, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // editbooktour
    $('[name="feditbooktour"]').click(function(){
        $('#editbooktour').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="fTourID"]').val($('#TourID',$row).text());
        $('input[name="fAnonymousBookTour"]').val($('#AnonymousBookTour',$row).text());
        $('input[name="fAnonymousEmail"]').val($('#AnonymousEmail',$row).text());
        $('input[name="fAnonymousAddress"]').val($('#AnonymousAddress',$row).text());
        $('input[name="fAnonymousPhone"]').val($('#AnonymousPhone',$row).text());
        $('input[name="fStatus"]').val($('#Status',$row).text());
        $('input[name="fDescription"]').val($('#Description',$row).text());
    });

    // edittour
    $('[name="fedittour"]').click(function(){
        $('#edittour').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="fTourName"]').val($('#fTourName',$row).text());
        $('input[name="fTimeStart"]').val($('#TimeStart',$row).text());
        $('input[name="fTimeEnd"]').val($('#TimeEnd',$row).text());
        $('input[name="fTourPrice"]').val($('#TourPrice',$row).text());
        $('input[name="fTourSale"]').val($('#TourSale',$row).text());
        $('input[name="fLocation"]').val($('#Location',$row).text());
        $('input[name="fDescription"]').val($('#Description',$row).text());
        $('input[name="fTourID"]').val($('#TourID',$row).text());
        $('input[name="fLeadcontent"]').val($('#Leadcontent',$row).text());
    });

    // editMountaineering
    $('[name="feditMountaineering"]').click(function(){
        $('#editMountaineering').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="fmountaineeringID"]').val($('#mountaineeringID',$row).text());
        $('input[name="fMountainName"]').val($('#mountainName',$row).text());
        $('input[name="fLocationX"]').val($('#locationX',$row).text());
        $('input[name="fLocationY"]').val($('#locationY',$row).text());
        $('input[name="fSheltering"]').val($('#sheltering',$row).text());
        $('input[name="fTechniques"]').val($('#techniques',$row).text());
        $('input[name="fDescription"]').val($('#description',$row).text());
    });

    // editService
    $('[name="feditService"]').click(function(){
        $('#editService').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="fserviceID"]').val($('#serviceID',$row).text());
        $('input[name="fServiceName"]').val($('#serviceName',$row).text());
        $('input[name="fPrice"]').val($('#price',$row).text());
        $('input[name="fVAT"]').val($('#vAT',$row).text());
        $('input[name="fSale"]').val($('#sale',$row).text());
        $('input[name="fDescription"]').val($('#description',$row).text());
    });

    // editNews
    $('[name="feditNews"]').click(function(){
        $('#editNews').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="fnewsID"]').val($('#newsID',$row).text());
        $('input[name="fTitle"]').val($('#title',$row).text());
        $('input[name="fLead"]').val($('#leadcontent',$row).text());
        $('input[name="fAuthor"]').val($('#author',$row).text());
        $('input[name="fDescription"]').val($('#description',$row).text());
    });

    // editLibrary
    $('[name="feditLibraryID"]').click(function(){
        $('#editlibrary').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="fLibraryID"]').val($('#libraryID',$row).text());
        $('input[name="fLibraryName"]').val($('#libraryName',$row).text());
        $('input[name="fDescription"]').val($('#description',$row).text());
    });

    // editimglibrary
    $('[name="feditimglibrary"]').click(function(){
        $('.editItemlibrary').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="fItemlibraryID"]').val($('#itemLibraryID',$row).text());
        $('input[name="fTitle"]').val($('#title',$row).text());
        $('input[name="fDescription"]').val($('#description',$row).text());
        $('input[name="fAlt"]').val($('#alt',$row).text());
    });

    // editvideolibrary
    $('[name="feditvideolibrary"]').click(function(){
        $('.editItemlibrary').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="fItemlibraryID"]').val($('#itemLibraryID',$row).text());
        $('input[name="fTitle"]').val($('#title',$row).text());
        $('input[name="fDescription"]').val($('#description',$row).text());
        $('input[name="fFileEdit"]').val($('#file',$row).text());
    });

    // editCategory
    $('[name="feditCategory"]').click(function(){
        $('#editcategory').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="fCategoryID"]').val($('#CategoryID',$row).text());
        $('input[name="fCategoryName"]').val($('#CategoryName',$row).text());
        $('input[name="fDescription"]').val($('#Description',$row).text());
    });

    // editCategorytour
    $('[name="feditCategorytour"]').click(function(){
        $('#editcategorytour').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="fCategorytourID"]').val($('#CategoryTourID',$row).text());
        $('input[name="fCategoryTourName"]').val($('#CategoryTourName',$row).text());
        $('input[name="fDescription"]').val($('#Description',$row).text());
    });

    // editlocationandservice
    $('[name="feditlocationandservice"]').click(function(){
        $('#editlocationandservice').removeClass("d-none");
        let $row = $(this).closest('tr');
        $('input[name="flocationandserviceID"]').val($('#locationAndServiceID',$row).text());
        $('input[name="fDescription"]').val($('#description',$row).text());
    });

    // add itemlibrary 2tab
    // $('[name="additemlibrary"]').click(function(){
    //     var $row = $(this).closest('tr');
    //     $('input[id="LibraryID"]').val($('#libraryName',$row).text());
    // });

});