<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold">
            Sales Pipeline
        </h2>
    </x-slot>
        <div class=" mx-auto sm:px-4 lg:px-4">
                <div class="my-6 flex flex-wrap gap-3">

                    <input
                        type="text"
                        id="searchLead"
                        placeholder="🔍 Search Lead..."
                        class="w-full md:w-80 rounded-lg border-gray-300 shadow-sm">

                    <select
                        id="sourceFilter"
                        class="rounded-lg border-gray-300 shadow-sm">

                        <option value="">All Sources</option>
                        <option>Website</option>
                        <option>Facebook</option>
                        <option>Referral</option>

                    </select>

                </div>
        </div>
    <div class=" mx-auto sm:px-4 lg:px-4">

        <div class="empty-column flex flex-col   justify-center h-500 text-gray-400">

            <div class="overflow-x-auto  pb-4">

              <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-4 gap-2">

                @php

                $columns = [

                    'New',

                    'Contacted',

                    'Qualified',

                    'Proposal',

                    'Negotiation',

                    'Won'

                ];

                @endphp

                @foreach($columns as $status)

                    <div class="bg-slate-100 rounded-xl p-2 min-h-[250px]   flex-shrink-0">

                        <div class="flex justify-between items-center mb-4">

                            <h3 class="font-bold text-lg">
                                {{ $status }}
                            </h3>
                            {{-- <span class="lead-count bg-white px-2 py-1 rounded-full"></span> --}}
                            <span class="lead-count bg-white px-2 py-1 rounded-full text-xs shadow">
                                {{ $leads->where('status',$status)->count() }}
                            </span>

                        </div>

                        <div
                            class="kanban-column min-h-[200px] space-y-4"
                            data-status="{{ $status }}">

                            @php
                                $columnLeads = $leads->where('status', $status);
                            @endphp

                            @foreach($columnLeads as $lead)

                                <div
                                    class="lead-card bg-white rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition duration-200 p-4 mb-4 cursor-grab select-none border border-gray-200"

                                    data-id="{{ $lead->id }}"
                                    data-name="{{ strtolower($lead->name) }}"
                                    data-email="{{ strtolower($lead->email) }}"
                                    data-source="{{ strtolower($lead->source) }}">

                                    <h4 class="font-semibold text-gray-800">
                                        {{ $lead->name }}
                                    </h4>
                                    <div class="flex justify-between items-center mt-2">

                                        @if($lead->value)

                                            <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">

                                                💰 ₹ {{ number_format($lead->value, 0) }}

                                            </span>

                                        @endif

                                    </div>

                                    <p class="text-sm text-gray-500 mt-2">
                                        {{ $lead->email }}
                                    </p>
                                    @php

                                        $followUp = $lead->followUps
                                            ->where('status', 'Pending')
                                            ->sortBy('follow_up_date')
                                            ->first();

                                    @endphp

                                    @if($followUp)

                                        @php
                                            $date = \Carbon\Carbon::parse($followUp->follow_up_date);
                                        @endphp

                                        <div class="mt-3">

                                            @if($date->isToday())

                                                <span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                                    📅 Today
                                                </span>

                                            @elseif($date->isTomorrow())

                                                <span class="inline-flex items-center px-2 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                                    📅 Tomorrow
                                                </span>

                                            @elseif($date->isPast())

                                                <span class="inline-flex items-center px-2 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                                    ⚠️ {{ $date->diffInDays(now()) }} day(s) overdue
                                                </span>

                                            @else

                                                <span class="inline-flex items-center px-2 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold">
                                                    📅 {{ (int) now()->startOfDay()->diffInDays($date->startOfDay()) }} day(s) left
                                                </span>

                                            @endif

                                        </div>

                                    @endif
                                    @if($lead->user)

                                        <div class="flex items-center mt-3">

                                            <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm font-bold">

                                                {{ strtoupper(substr($lead->user->name,0,1)) }}

                                            </div>

                                            <span class="ml-2 text-sm text-gray-700">

                                                {{ $lead->user->name }}

                                            </span>

                                        </div>

                                    @endif

                                    <div class="flex justify-between items-center mt-4">

                                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">
                                            {{ $lead->source }}
                                        </span>

                                        <a href="{{ route('leads.show',$lead) }}"
                                        class="text-xs text-indigo-600">
                                            View →
                                        </a>

                                    </div>

                                </div>

                            @endforeach

                            @if($columnLeads->count() == 0)

                                <div class="flex flex-col items-center justify-center h-48 text-gray-400">

                                    <div class="text-4xl">📭</div>

                                    <p class="mt-3 text-sm">
                                        No Leads
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>

                @endforeach

              </div>
            </div>

        </div>
    </div>
<div id="toast"
class="hidden fixed top-5 right-5 bg-green-600 text-white px-5 py-3 rounded-lg shadow-xl z-50">
</div>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script>
   document.querySelectorAll('.kanban-column').forEach(function(column){

    // new Sortable(column,{

    //     group:'kanban',

    //     animation:200,

    //     ghostClass:'bg-blue-100',

    //     chosenClass:'opacity-70',

    //     dragClass:'rotate-1',

    //     forceFallback:true,

    //     onEnd:function(evt){

    //         let leadId=evt.item.dataset.id;

    //         let newStatus=evt.to.dataset.status;

    //         fetch('/kanban/'+leadId,{

    //             method:'PUT',

    //             headers:{
    //                 'Content-Type':'application/json',
    //                 'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
    //             },

    //             body:JSON.stringify({
    //                 status:newStatus
    //             })

    //         })
    //         .then(res=>res.json())
    //         .then(data=>{

    //             if(data.success){

    //                 updateCounts();

    //                 updateEmptyColumns();

    //                 toast('Lead moved to '+newStatus);

    //             }

    //         });

    //     }

    // });
    new Sortable(column,{

        group:'kanban',

        animation:200,

        ghostClass:'bg-blue-100',

        chosenClass:'opacity-70',

        dragClass:'rotate-1',

        forceFallback:true,

        onStart:function(){

            document.querySelectorAll('.kanban-column').forEach(function(col){

                col.classList.add('drop-zone');

            });

        },

        onEnd:function(evt){

            document.querySelectorAll('.kanban-column').forEach(function(col){

                col.classList.remove('drop-zone');

            });

            let leadId=evt.item.dataset.id;

            let newStatus=evt.to.dataset.status;

            fetch('/kanban/'+leadId,{

                method:'PUT',

                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
                },

                body:JSON.stringify({
                    status:newStatus
                })

            })
            .then(res=>res.json())
            .then(data=>{

                if(data.success){
                    evt.item.classList.add('flash-success');

                    setTimeout(function(){

                        evt.item.classList.remove('flash-success');

                    },800);

                    updateCounts();

                    updateEmptyColumns();


                    toast('✅ Lead moved to '+newStatus);



                }

            });

        }

    });

});
// function updateCounts(){

//     document.querySelectorAll('.kanban-column').forEach(function(column){

//         let count=column.querySelectorAll('.lead-card').length;

//         column.closest('.bg-slate-100')
//               .querySelector('.lead-count')
//               .innerText=count;

//     });

// }
function updateEmptyColumns(){

    document.querySelectorAll('.kanban-column').forEach(function(column){

        let cards=column.querySelectorAll('.lead-card');

        let empty=column.querySelector('.empty-column');

        if(cards.length>0){

            if(empty){
                empty.remove();
            }

        }else{

            if(!empty){

                column.insertAdjacentHTML('beforeend',`

                    <div class="empty-column flex flex-col items-center justify-center h-48 text-gray-400">

                        📭

                        <p>No Leads</p>

                    </div>

                `);

            }

        }

    });

}
function toast(message){

    let t=document.getElementById('toast');

    t.innerHTML=message;

    t.classList.remove('hidden');

    setTimeout(function(){

        t.classList.add('hidden');

    },2000);

}
const search=document.getElementById('searchLead');

search.addEventListener('keyup',function(){

    let keyword=this.value.toLowerCase();

    document.querySelectorAll('.lead-card').forEach(function(card){

        let name=card.dataset.name;
        let email=card.dataset.email;

        if(name.includes(keyword) || email.includes(keyword)){

            card.style.display='block';

        }else{

            card.style.display='none';

        }

    });

});
const source=document.getElementById('sourceFilter');

source.addEventListener('change',function(){

    let value=this.value.toLowerCase();

    document.querySelectorAll('.lead-card').forEach(function(card){

        if(value=='' || card.dataset.source==value){

            card.style.display='block';

        }else{

            card.style.display='none';

        }

    });

});
function updateCounts(){

    document.querySelectorAll('.kanban-column').forEach(function(column){

        const visibleCards = [...column.querySelectorAll('.lead-card')]
            .filter(card => card.style.display !== 'none');

        column.closest('.bg-slate-100')
              .querySelector('.lead-count')
              .innerText = visibleCards.length;

    });

}
</script>
</x-app-layout>
