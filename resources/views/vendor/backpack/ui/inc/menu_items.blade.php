{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Artists" icon="la la-question" :link="backpack_url('artist')" />
<x-backpack::menu-item title="Artist types" icon="la la-question" :link="backpack_url('artist-type')" />
<x-backpack::menu-item title="Localities" icon="la la-question" :link="backpack_url('locality')" />
<x-backpack::menu-item title="Locations" icon="la la-question" :link="backpack_url('location')" />
<x-backpack::menu-item title="Representations" icon="la la-question" :link="backpack_url('representation')" />
<x-backpack::menu-item title="Representation users" icon="la la-question" :link="backpack_url('representation-user')" />
<x-backpack::menu-item title="Roles" icon="la la-question" :link="backpack_url('role')" />
<x-backpack::menu-item title="Role users" icon="la la-question" :link="backpack_url('role-user')" />
<x-backpack::menu-item title="Shows" icon="la la-question" :link="backpack_url('show')" />
<x-backpack::menu-item title="Types" icon="la la-question" :link="backpack_url('type')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />