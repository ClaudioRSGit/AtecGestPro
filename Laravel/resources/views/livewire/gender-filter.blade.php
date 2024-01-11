<div>
    <label for="gender">Selecione o género</label>
    <select wire:model="gender" class="form-select" id="gender" name="gender">
        <option value="male">Masculino</option>
        <option value="female">Femenino</option>
    </select>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">
                <input type="checkbox" id="select-all">
            </th>
            <th scope="col">Nome</th>
            <th scope="col" style="text-align: center;">Tamanho</th>
            <th scope="col" style="text-align: center;">Quantidade</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clothes->groupBy('name') as $clothingName => $clothingItems)
            @php
                //dd($stock);
                $firstClothingItem = $clothingItems->first();
                $uniqueSizes = $clothingItems->unique('size');
                $defaultValue = $uniqueSizes[0]->size;

                //dd($uniqueSizes);
            @endphp
            <tr class="material-row" data-trainee="{{ $firstClothingItem->role == 3 ? 1 : 0 }}">
                <td>
                    <div class="form-check" >
                        <input class="form-check-input" name="selectedClothing[]" type="checkbox"
                               value="{{ $firstClothingItem->name }}" id="flexCheckDefault" >
                    </div>
                </td>
                <td>
                    <div >
                    {{ $clothingName }}
                    <input type="hidden" name="name[{{ $firstClothingItem->id }}]" value="{{ $firstClothingItem->name }}" >
                    </div>
                </td>

                <td style="text-align: center;">
                    <select class="form-select" name="size[{{ $firstClothingItem->name }}]" wire:model="selectedSizes.{{ $firstClothingItem->name }}" wire:change="updateStock('{{ $firstClothingItem->name }}')">
                        @foreach($uniqueSizes as $uniqueSize)
                            <option value="{{ $uniqueSize->size }}">{{ $uniqueSize->size }}</option>
                        @endforeach
                    </select>
                </td>


                <td>
                    <div>
                        <input type="number" class="form-control w-50" name="quantity[{{ $firstClothingItem->name }}]" id="quantity"
                               value="0" min="0" max="{{ $stock[$firstClothingItem->name] ?? 3 }}" >
                    </div>
                </td>
            </tr>
        @endforeach



        </tbody>
    </table>

    <h5>Observações </h5>
    <div class="row">
        <div class="col-4">
            <textarea class="form-control" name="additionalNotes" id="textarea" aria-label="With textarea"></textarea>
        </div>
    </div>
</div>


