@php $editing = isset($user) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="الاسم"
            :value="old('name', ($editing ? $user->name : ''))"
            maxlength="255"
            placeholder="الاسم"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="gender" label="الجنس">
            @php $selected = old('gender', ($editing ? $user->gender : '')) @endphp
            <option value="ذكر" {{ $selected == 'ذكر' ? 'selected' : '' }} >ذكر</option>
            <option value="أنثى" {{ $selected == 'أنثى' ? 'selected' : '' }} >أنثى</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="phone"
            label="رقم الهاتف"
            :value="old('phone', ($editing ? $user->phone : ''))"
            placeholder="رقم الهاتف"
            maxlength="10"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="البريد الالكتروني"
            :value="old('email', ($editing ? $user->email : ''))"
            maxlength="255"
            placeholder="البريد الالكتروني"
            required
        ></x-inputs.email>
    </x-inputs.group>    
    <x-inputs.group class="col-sm-12">
        <label class="form-label {{ $editing ? '': 'required' }}">
            كلمة المرور
        </label>
        <div class="input-group input-group-flat @error('password') is-invalid @enderror">
            <input type="password" maxlength="255" placeholder="كلمة المرور" id="password"  class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" 
            {{ $editing ? '' : 'required' }} autocomplete="password" autofocus>
            <span class="input-group-text">
                <a href="#" class="link-secondary" title="عرض كلمة المرور" data-bs-toggle="tooltip" onclick="showPassword()">
                    <i class="ti ti-eye"></i>
                </a>
            </span>
        </div>
        {{-- <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            placeholder="Password"
            :required="!$editing"
        ></x-inputs.password> --}}
    </x-inputs.group>

    <div class="form-group col-sm-12 mt-4">
        <h4>تعيين @lang('crud.roles.name')</h4>

        @foreach ($roles as $role)
        <div>
            <x-inputs.checkbox
                id="role{{ $role->id }}"
                name="roles[]"
                label="{{ ucfirst($role->name) }}"
                value="{{ $role->id }}"
                :checked="isset($user) ? $user->hasRole($role) : false"
                :add-hidden-value="false"
            ></x-inputs.checkbox>
        </div>
        @endforeach
    </div>
</div>
