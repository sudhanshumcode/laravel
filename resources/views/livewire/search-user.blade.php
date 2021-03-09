<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input wire:model="search" type="text" placeholder="Enter user name">
            </div>
            <div class="show_result">
                <div class="col-md-12">
                    @foreach($users as $u)
                    <li>{{ @$u->name }}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
