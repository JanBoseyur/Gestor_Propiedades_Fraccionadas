
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class = "inset-0 bg-opacity-50 z-50 flex justify-center items-center p-4">
        
        <div class = "bg-[#F9F5F0] dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-lg">
        <h3 class = "text-xl font-bold text-[#2E6C6F] dark:text-white mb-4">Editar Socio</h3>
        <div class = "space-y-4 max-h-[70vh] overflow-y-auto pr-2">
            <div class = "grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label htmlFor = "edit-name" class = "block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre Completo</label>
                    <input type = "text" id="edit-name" value = {name} onChange = {e => setName(e.target.value)} className="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 shadow-sm focus:border-[#2E6C6F] focus:ring-[#2E6C6F]" />
                </div>
                <div>
                    <label htmlFor="edit-email" class = "block text-sm font-medium text-gray-700 dark:text-gray-300">Correo Electrónico</label>
                    <input type="email" id="edit-email" value={email} onChange={e => setEmail(e.target.value)} className="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 shadow-sm focus:border-[#2E6C6F] focus:ring-[#2E6C6F]" />
                </div>
                <div>
                    <label htmlFor = "edit-partnerIdNumber" class = "block text-sm font-medium text-gray-700 dark:text-gray-300">Nro. Identificación (RUT, DNI)</label>
                    <input type = "text" id="edit-partnerIdNumber" value = {partnerIdNumber} onChange={e => setPartnerIdNumber(e.target.value)} className="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 shadow-sm focus:border-[#2E6C6F] focus:ring-[#2E6C6F]" />
                </div>
                <div>
                    <label htmlFor = "edit-phone" class = "block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                    <input type = "tel" id="edit-phone" value = {phone} onChange={e => setPhone(e.target.value)} className="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 shadow-sm focus:border-[#2E6C6F] focus:ring-[#2E6C6F]" />
                </div>
                <div class = "md:col-span-2">
                    <label htmlFor = "edit-address" class = "block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
                    <input type = "text" id = "edit-address" value = {address} onChange = {e => setAddress(e.target.value)} className="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 shadow-sm focus:border-[#2E6C6F] focus:ring-[#2E6C6F]" />
                </div>
                <div>
                    <label htmlFor = "edit-city" class = "block text-sm font-medium text-gray-700 dark:text-gray-300">Ciudad</label>
                    <input type = "text" id = "edit-city" value = {city} class = "mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 shadow-sm focus:border-[#2E6C6F] focus:ring-[#2E6C6F]" />
                </div>
                <div>
                    <label htmlFor="edit-country" class = "block text-sm font-medium text-gray-700 dark:text-gray-300">País</label>
                    <input type = "text" id="edit-country" value = {country} onChange = {e => setCountry(e.target.value)} className="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 shadow-sm focus:border-[#2E6C6F] focus:ring-[#2E6C6F]" />
                </div>
            </div>
            {error && <p class = "text-sm text-red-600">{error}</p>}
        </div>
        <div class = "mt-6 flex justify-end space-x-3">
            <button onClick = {onClose} class = "px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancelar</button>
            <button onClick = {handleSave} class = "px-4 py-2 bg-[#2E6C6F] text-white rounded-md hover:bg-[#265a5c]">Guardar Cambios</button>
        </div>
        </div>

    </div>
@endsection