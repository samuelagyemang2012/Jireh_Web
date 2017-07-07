function for_title() {

    var select_data = document.getElementById('fortitle').value;

    document.getElementById('i-title').value = select_data;

    var fake = document.getElementById('fake_title');

    if (select_data == '1') {
        fake.value = 'MR';
    }

    if (select_data == '2') {
        fake.value = 'MISS';
    }

    if (select_data == '3') {
        fake.value = 'MRS';
    }

    if (select_data == '4') {
        fake.value = 'DR';
    }

    if (select_data == '5') {
        fake.value = 'REV';
    }
}

function for_gender() {

}