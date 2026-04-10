@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center bg-gray-50 py-12 px-4">
    <div class="max-w-lg w-full bg-white p-10 rounded-[2.5rem] shadow-2xl border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-black text-[#1B2E58] uppercase italic tracking-tighter">Inscription Abonné</h2>
            <div class="h-1.5 w-12 bg-[#FFB75E] mx-auto mt-2 rounded-full"></div>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @csrf
            <div class="md:col-span-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Nom complet</label>
                <input type="text" name="nom_complet" required class="w-full px-5 py-3.5 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FFB75E] outline-none">
            </div>
            
            <div class="md:col-span-1">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Email</label>
                <input type="email" name="email" required class="w-full px-5 py-3.5 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FFB75E] outline-none">
            </div>

            <div class="md:col-span-1">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Téléphone</label>
                <input type="text" name="telephone" required class="w-full px-5 py-3.5 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FFB75E] outline-none" placeholder="+229...">
            </div>

            <div class="md:col-span-1">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Mot de passe</label>
                <input type="password" name="password" required class="w-full px-5 py-3.5 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FFB75E] outline-none">
            </div>

            <div class="md:col-span-1">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Confirmation</label>
                <input type="password" name="confirmpassword" required class="w-full px-5 py-3.5 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FFB75E] outline-none">
            </div>

            <div class="md:col-span-2 mt-4">
                <button type="submit" class="w-full bg-[#FFB75E] py-5 rounded-2xl text-white font-black uppercase tracking-widest shadow-xl hover:bg-[#1B2E58] transition-all duration-300">
                    S'inscrire maintenant
                </button>
            </div>
        </form>

        <div class="text-center mt-8">
            <a href="{{ route('login') }}" class="text-gray-400 text-sm font-medium hover:underline tracking-tight">Déjà un compte ? Connectez-vous</a>
        </div>
    </div>
</div>
@endsection