<section>
    <div class="mb-3 col-9">
        <label for="newCharacteristicName" class="form-label">Добавьте характеристики товара</label>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Добавить новую характеристику
        </button>
    </div>

    <div class="border rounded col-9 p-3 mb-4 bg-secondary" id="characteristic">
        <div class="row">
            <div class="col-6">
                <div class="font-weight-bold mb-2">Выберите характеритики товара</div>
                <div class="mb-3">
                    <select id="characteristicSelect" name="selected_characteristic"
                            class="form-select form-select-lg mb-3" aria-label="Large select">
                        <option selected>
                            <button>Добавьте характеристики товара</button>
                        </option>
                        @foreach($allCharacteristics as $characteristic)
                            <option
                                value="{{$characteristic->id}}">{{$characteristic->characteristic_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <label for="characteristicValueInput" class="font-weight-bold mb-2 ">Введите значение</label>
                <div class="mb-3">
                    <input type="text" id="characteristicValueInput" name="characteristic_value"
                           class="form-control form-control-lg" placeholder="Введите значение">
                </div>
            </div>

            <div class="col-3 d-flex flex-column">
                <div class="font-weight-bold mb-2 visually-hidden"></div>
                <div class="mb-3 mt-auto">
                    <button type="button" class="btn-lg border-1 btn-warning col-12" onclick="submitForm()">Добавить
                        характеристику
                    </button>
                </div>
            </div>
        </div>

        <table id="characteristicsList" class="table d-none fade">
            <thead>
            <tr>
                <th scope="col">Характеристика товара</th>
                <th scope="col">Значение</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($characteristics))
                @foreach($characteristics as $characteristic)
                    <tr>
                        <td>{{$characteristic->characteristic_name}}</td>
                        <td>{{$characteristic->pivot->value}}</td>
                        <td><a href="javascript:void(0);" type="button" class="btn border-1 btn-danger"
                               onclick="removeRow(this)">Удалить</a></td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{asset('js/characteristics.js')}}"></script>

<script>
    @if(isset($allCharacteristics))
    const initialCharacteristics = [];
    let characteristicsFromBlade = {!! json_encode($allCharacteristics) !!};
    initialCharacteristics.push(...characteristicsFromBlade);
    @endif

    const savedCharacteristics = [];
    @if(isset($characteristics))
    const characteristicsList = document.getElementById('characteristicsList');
    characteristicsList.classList.remove('d-none');
    characteristicsList.classList.add('show');
    let currentCharacteristics = {!! json_encode($characteristics) !!};
    currentCharacteristics.forEach(characteristic => {

        const savedCharacteristic = `${characteristic.id}|${characteristic.characteristic_name}`
        savedCharacteristics.push(savedCharacteristic);
        updateHiddenInput(savedCharacteristic);
    })
    @endif

</script>


