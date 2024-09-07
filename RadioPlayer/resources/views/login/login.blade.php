@extends('Layouts.app')

@section('content')
    <div class="bg-cover bg-no-repeat h-screen w-screen " style="background-image: url({{ url('images/Login.png') }})">
        <div class="flex items-center justify-center px-6 py-8 mx-auto sm:h-screen lg:py-0">
            <div class="grid grid-rows-6 sm:grid-rows-3 grid-flow-col gap-4 text-center w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-4xl p-10"
                style="background-color: #FFEED9;">
                <div class="flex text-6xl sm:text-8xl font-semibold justify-center items-center">
                    <h1>LOGIN</h1>
                </div>
                <div class="row-span-3 sm:row-span-3 ">

                    <form class="space-y-4 md:space-y-6" action="{{ route('loginPost') }}" method="post">
                        @csrf
                        <div>
                            <label for="username"
                                class="block mb-2 text-sm text-left font-bold text-gray-900 text-black">USERNAME</label>
                            <input type="username" name="username" id="username"
                                class="bg-transparent border border-gray-600 focus:ring-2 focus:outline-none focus:ring-sky-600 text-gray-900 rounded-lg block w-full p-2.5"
                                required="">
                                @error('username')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-left text-sm font-bold text-gray-900 text-black">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-transparent border border-gray-600 focus:ring-2 focus:outline-none focus:ring-sky-600 text-gray-900 rounded-lg  block w-full p-2.5"
                                required="">
                                @error('password')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                        </div>
                        <button type="submit"
                            class="w-full button-text bg-orange-300 hover:bg-orange-400 focus:ring-4 focus:outline-none focus:ring-sky-600 font-bold rounded-lg text-sm px-5 py-2.5 text-center ">LOGIN</button>
                    </form>
                </div>
                <div class="flex row-span-2 sm:row-span-4 justify-center items-center"><img
                        class="max-w-none size-32 sm:size-fit" src="{{ url('images/logo petra campus radio.png') }}"
                        alt="..."></div>
            </div>
        </div>
    </div>

    </div>
@endsection
