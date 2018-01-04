function show(el) {
    document.getElementById(el).style.display = "flex";
}
function hide(el) {
    document.getElementById(el).style.display = "none";
}
function add() {
    document.getElementById("no_subjects").value++;
    display_subjects('up');
}
function subtract() {
    if (document.getElementById("no_subjects").value > 1)
        document.getElementById("no_subjects").value--;
    display_subjects('down');
}
function show_semester() {
    var sel = document.getElementById("mcourse");
    var duration = sel.options[sel.selectedIndex].getAttribute("data-course-duration");
    var sem = document.getElementById("msemester");
    sem.innerHTML = `<option disabled selected>Select semester</option> `;
    for (var i = 1; i <= (duration * 2); i++) {
        sem.innerHTML += `
            <option value="`+ i + `">` + i + `</option>
            `;
    }
}
function display_subjects(direction) {
    var val = document.getElementById("no_subjects").value;
    var table = document.getElementById("subject_area");
    table.innerHTML = "";
    if (isNaN(val)) {
        table.innerHTML = "Add a subject to insert";
    }
    else {

        for (var i = 1; i <= val; i++) {
            table.innerHTML += `
                        <tr>
                <td>
                <input type="text" name="subcode`+ i + `" id="subcode` + i + `" class="form-control" required>
                </td>
                <td>
                <input type="text" name="subname`+ i + `" id="subname` + i + `" class="form-control" required>
                </td>
                <td>
                <select name="type`+ i + `" id="type` + i + `" class="form-control" onchange="check_credits(this,` + i + `)">            
                <option value="theory">Theory</option>
                    <option value="practical">Practical</option>
                <option value="both" selected>Both</option>         
                    </select>
                </td>
                
                <td>
                <input type="number" name="theory`+ i + `" id="theory` + i + `" class="form-control" onkeyup="total(` + i + `)" onchange="total(` + i + `); validate(this,100)" onfocusout="validate_focus(this,100)" value=0 required>
                </td>
                <td>
                <input type="number" name="practical`+ i + `" id="practical` + i + `" class="form-control" onkeyup="total(` + i + `)" onchange="total(` + i + `); validate(this,100)" onfocusout="validate_focus(this,100)" value=0 required> 
                </td>
                <td><input id="total`+ i + `" name="total` + i + `" class="form-control disabled" readonly type="number"></td>
                <td style="text-align: center">
                <input type="checkbox" name="ie`+ i + `" id="ie` + i + `" class="form-control" onchange="disable_credits(this,` + i + `)">
                </td>
                <td style="text-align: center">
                <input type="checkbox" name="elective`+ i + `" id="elective` + i + `" class="form-control">
                </td>  `;
        }
    }

}
function total(no) {
    var theory = parseInt(document.getElementById("theory" + no).value);
    var practical = parseInt(document.getElementById("practical" + no).value);
    document.getElementById("total" + no).value = theory + practical;
}
function disable_credits(el, no) {
    var practical = document.getElementById("practical" + no);
    var theory = document.getElementById("theory" + no);
    if (el.checked) {
        practical.classList.add("disabled");
        practical.required = false;
        practical.disabled = true;
        theory.classList.add("disabled");
        theory.required = false;
        theory.disabled = true;
        theory.value = 0;
        practical.value = 0;
    }
    else {

        practical.classList.remove("disabled");
        practical.required = true;
        practical.disabled = false;
        theory.classList.remove("disabled");
        theory.required = true;
        theory.disabled = false;
    }
}
function check_credits(el, no) {
    var typename = el.options[el.selectedIndex].value;
    console.log(typename);
    var practical = document.getElementById("practical" + no);
    var theory = document.getElementById("theory" + no);
    switch (typename) {
        case 'theory':
            practical.classList.add("disabled");
            practical.required = false;
            practical.disabled = true;
            theory.classList.remove("disabled");
            theory.required = true;
            theory.disabled = false;
            practical.value = 0;
            break;
        case 'practical':
            theory.classList.add("disabled");
            theory.required = false;
            theory.disabled = true;
            practical.classList.remove("disabled");
            practical.required = true;
            practical.disabled = false;
            theory.value = 0;
            break;
        case 'both':
            theory.classList.remove("disabled");
            theory.required = true;
            theory.disabled = false;
            practical.classList.remove("disabled");
            practical.required = true;
            practical.disabled = false;
            break;
    }
}