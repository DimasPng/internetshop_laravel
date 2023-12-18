// This initial part of code is in characteristics-form.blade.php.
// Do not uncomment the lines below
// @if(isset($characteristics))
// const initialCharacteristics = [];
// let characteristicsFromBlade = {!! json_encode($characteristics) !!};
// initialCharacteristics.push(...characteristicsFromBlade);
// @endif
function submitForm() {
    const characteristicsData = initialCharacteristics;
    const selectedCharacteristic = document.getElementById('characteristicSelect').value;
    const enteredValue = document.getElementById('characteristicValueInput');

    if (enteredValue.value.trim() === '') {
        enteredValue.classList.add('is-invalid');
        return;
    }

    const existingCharacteristic = findExistingCharacteristic(selectedCharacteristic);

    if (!existingCharacteristic) {
        const newRow = createTableRow(characteristicsData, selectedCharacteristic, enteredValue.value);

        updateCharacteristicsList(newRow);
        updateSavedCharacteristics(selectedCharacteristic, enteredValue.value);

        clearInput(enteredValue);

        enteredValue.classList.remove('is-invalid');

        updateHiddenInput(savedCharacteristics);
    }
}

function findExistingCharacteristic(selectedCharacteristic) {
    return savedCharacteristics.find(item => {
        const [charId] = item.split('|');
        return charId === selectedCharacteristic;
    });
}

function createTableRow(characteristicsData, selectedCharacteristic, enteredValue) {
    const characteristicsListTbody = document.getElementById('characteristicsList').querySelector('tbody');
    const newRow = document.createElement('tr');

    newRow.appendChild(createTableCell('align-middle', characteristicsData[selectedCharacteristic - 1].characteristic_name));
    newRow.appendChild(createTableCell('align-middle', enteredValue));
    newRow.appendChild(createRemoveButtonCell());

    characteristicsListTbody.appendChild(newRow);

    const characteristicsList = document.getElementById('characteristicsList');
    characteristicsList.classList.remove('d-none');
    characteristicsList.classList.add('show');

    return newRow;
}

function createTableCell(className, textContent) {
    const cell = document.createElement('td');
    cell.className = className;
    cell.textContent = textContent;
    return cell;
}

function createRemoveButtonCell() {
    const cell = document.createElement('td');
    cell.className = 'align-middle';
    cell.innerHTML = '<a href="javascript:void(0);" type="button" class="btn border-1 btn-danger" onclick="removeRow(this)">Удалить</a>';
    return cell;
}

function updateCharacteristicsList(newRow) {
    const characteristicsListTbody = document.getElementById('characteristicsList').querySelector('tbody');
    characteristicsListTbody.appendChild(newRow);
}

function updateSavedCharacteristics(selectedCharacteristic, enteredValue) {
    savedCharacteristics.push(`${selectedCharacteristic}|${enteredValue}`);
}

function clearInput(inputElement) {
    inputElement.value = '';
}

function updateHiddenInput(savedCharacteristics) {
    console.log('savedCharacteristics', savedCharacteristics)
    let input = document.getElementById('newCharacteristic');

    if (!input) {
        input = createHiddenInput();
        const form = document.getElementById('productForm');
        form.appendChild(input);
    }

    input.value = JSON.stringify(savedCharacteristics);
}

function createHiddenInput() {
    const input = document.createElement('input');
    input.id = 'newCharacteristic';
    input.type = 'hidden';
    input.name = 'characteristics';
    console.log('input add')
    return input;
}

function removeRow(closestBtn) {
    const characteristicsId = getCharacteristicsIdMap(initialCharacteristics);
    console.log(getCharacteristicsIdMap(initialCharacteristics))
    const rowToRemove = closestBtn.closest('tr');
    const characteristicName = rowToRemove.querySelector('td:first-child').textContent;
    const selectedCharacteristic = characteristicsId[characteristicName];

    console.log(savedCharacteristics)
    const indexToRemove = savedCharacteristics.findIndex(item => {
        console.log('item', item)
        const [charId] = item.split("|");
        return charId === selectedCharacteristic.toString();
    });
    console.log(savedCharacteristics)
    if (indexToRemove !== -1) {
        savedCharacteristics.splice(indexToRemove, 1);
        rowToRemove.remove();

        updateCharacteristicsListVisibility();

        updateHiddenInput(savedCharacteristics);
    }
}

function updateCharacteristicsListVisibility() {
    const characteristicsList = document.getElementById('characteristicsList');

    if (savedCharacteristics.length === 0) {
        characteristicsList.classList.add('d-none');
        characteristicsList.classList.remove('show');
    }
}

function getCharacteristicsIdMap(characteristicsData) {
    const characteristicsId = {};
    for (const key in characteristicsData) {
        characteristicsId[characteristicsData[key].characteristic_name] = characteristicsData[key].id;
    }
    return characteristicsId;
}

$(document).ready(function addNewCharacteristic() {
    $('#submitBtn').click(function () {
        $.ajax({
            type: 'POST',
            url: $('#characteristicsForm').attr('action'),
            data: $('#characteristicsForm').serialize(),
            success: function (data) {
                const characteristicSelect = $('#characteristicSelect');
                const newOption = $('<option>', {
                    value: data.id,
                    text: data.characteristic_name,
                });
                characteristicSelect.append(newOption);
                characteristicSelect.val(data.id);

                initialCharacteristics.push(data)

                $('#exampleModal').modal('hide');
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
