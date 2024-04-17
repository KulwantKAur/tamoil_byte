@extends('layouts.app')

@section('title', 'Inbound')

@section('content')
    <div class="main-container pt-10 pb-10">
        <div class="flex-between mb-10">
            <button class="grey-btn btn">
                <a href="/receipt/b2creturn" onclick="disableParentButton(event)">
                    <span class="bold-text">B2C Return</span>
                </a>
            </button>
            <button class="grey-btn btn">
                <a href="/receipt/b2breturn" onclick="disableParentButton(event)">
                    <span class="bold-text">B2B Return</span>
                </a>
            </button>
            <button class="grey-btn btn">
                <a href="/receipt/umbuchen" onclick="disableParentButton(event)">
                    <span class="bold-text">Umbuchen</span>
                </a>
            </button>
			<button class="grey-btn btn">
                <a href="/receipt/wareneingang" onclick="disableParentButton(event)">
                    <span class="bold-text">Wareneingang</span>
                </a>
            </button>
            <button class="grey-btn btn">
                <a href="/" >
                    <span class="bold-text">Zurück</span>
                </a>
            </button>
        </div>
    </div>
@endsection
