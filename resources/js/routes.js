// import Dashboard from './components/Dashboard.vue';
// import Products from './pages/products/ListProducts.vue';
// import Expenses from './pages/expenses/ListExpenses.vue';
// import Categories from './pages/categories/ListCategories.vue';
// import CreateCategories from './pages/categories/CreateCategories.vue';
// import EditCategories from './pages/categories/EditCategories.vue';
// import ShowCategories from './pages/categories/ShowCategories.vue';

//IMPORT COMPONENT FOR ADMIN ROUTES
import Login from './pages/auth/Login.vue';
import Dashboard from './components/Dashboard.vue';
import DashboardManager from './components/DashboardManager.vue';
import DashboardAssociate from './components/DashboardAssociate.vue';
import AdminIndex from './pages/admin/admins/AdminIndex.vue';
import AdminCreate from './pages/admin/admins/AdminCreate.vue';
import AdminShow from './pages/admin/admins/AdminShow.vue';
import AdminEdit from './pages/admin/admins/AdminEdit.vue';
import ManagerIndex from './pages/admin/managers/ManagerIndex.vue';
import ManagerCreate from './pages/admin/managers/ManagerCreate.vue';
import ManagerShow from './pages/admin/managers/ManagerShow.vue';
import ManagerEdit from './pages/admin/managers/ManagerEdit.vue';
import AssociateIndex from './pages/admin/associates/AssociateIndex.vue';
import AssociateCreate from './pages/admin/associates/AssociateCreate.vue';
import AssociateShow from './pages/admin/associates/AssociateShow.vue';
import AssociateEdit from './pages/admin/associates/AssociateEdit.vue';
import ExpensesIndex from './pages/admin/expenses/ExpensesIndex.vue';
import ExpensesCreate from './pages/admin/expenses/ExpensesCreate.vue';
import ExpensesShow from './pages/admin/expenses/ExpensesShow.vue';
import ExpensesEdit from './pages/admin/expenses/ExpensesEdit.vue';
import EventsIndex from './pages/admin/events/EventsIndex.vue';
import EventsCreate from './pages/admin/events/EventsCreate.vue';
import EventsShow from './pages/admin/events/EventsShow.vue';
import EventsEdit from './pages/admin/events/EventsEdit.vue';
import CalendarsIndex from './pages/admin/calendars/CalendarsIndex.vue';
import NotificationsIndex from './pages/admin/notifications/NotificationsIndex.vue';
import ConfigurationsIndex from './pages/admin/configurations/ConfigurationsIndex.vue';
import QuotesIndex from './pages/admin/quotes/QuotesIndex.vue';
import QuotesCreate from './pages/admin/quotes/QuotesCreate.vue';
import QuotesShow from './pages/admin/quotes/QuotesShow.vue';
import QuotesEdit from './pages/admin/quotes/QuotesEdit.vue';
import ActivityIndex from './pages/admin/activity/ActivityIndex.vue';
import ActivityCreate from './pages/admin/activity/ActivityCreate.vue';

//IMPORT COMPONENTS FOR MANAGER ROUTES
import ManagerManagerIndex from './pages/manager/managers/ManagerIndex.vue';
import ManagerManagerCreate from './pages/manager/managers/ManagerCreate.vue';
import ManagerManagerShow from './pages/manager/managers/ManagerShow.vue';
import ManagerManagerEdit from './pages/manager/managers/ManagerEdit.vue';

import ManagerAssociateIndex from './pages/manager/associates/AssociateIndex.vue';
import ManagerAssociateCreate from './pages/manager/associates/AssociateCreate.vue';
import ManagerAssociateShow from './pages/manager/associates/AssociateShow.vue';
import ManagerAssociateEdit from './pages/manager/associates/AssociateEdit.vue';

import ManagerExpensesIndex from './pages/manager/expenses/ExpensesIndex.vue';
import ManagerExpensesCreate from './pages/manager/expenses/ExpensesCreate.vue';
import ManagerExpensesShow from './pages/manager/expenses/ExpensesShow.vue';
import ManagerExpensesEdit from './pages/manager/expenses/ExpensesEdit.vue';

import ManagerQuotesIndex from './pages/manager/quotes/QuotesIndex.vue';
import ManagerQuotesCreate from './pages/manager/quotes/QuotesCreate.vue';
import ManagerQuotesShow from './pages/manager/quotes/QuotesShow.vue';
import ManagerQuotesEdit from './pages/manager/quotes/QuotesEdit.vue';

import ManagerEventsIndex from './pages/manager/events/EventsIndex.vue';
import ManagerEventsCreate from './pages/manager/events/EventsCreate.vue';
import ManagerEventsShow from './pages/manager/events/EventsShow.vue';
import ManagerEventsEdit from './pages/manager/events/EventsEdit.vue';
import ManagerCalendarsIndex from './pages/manager/calendars/CalendarsIndex.vue';
import ManagerNotificationsIndex from './pages/manager/notifications/NotificationsIndex.vue';
import ManagerConfigurationsIndex from './pages/manager/configurations/ConfigurationsIndex.vue';


import AssociateQuotesIndex from './pages/associate/quotes/QuotesIndex.vue';
import AssociateQuotesCreate from './pages/associate/quotes/QuotesCreate.vue';
import AssociateQuotesShow from './pages/associate/quotes/QuotesShow.vue';
import AssociateQuotesEdit from './pages/associate/quotes/QuotesEdit.vue';

import AssociateEventsIndex from './pages/associate/events/EventsIndex.vue';
import AssociateEventsShow from './pages/associate/events/EventsShow.vue';
import AssociateCalendarsIndex from './pages/associate/calendars/CalendarsIndex.vue';
import AssociateNotificationsIndex from './pages/associate/notifications/NotificationsIndex.vue';
import AssociateConfigurationsIndex from './pages/associate/configurations/ConfigurationsIndex.vue';

import AssociateAssociatesIndex from './pages/associate/associates/AssociateIndex.vue';
import AssociateAssociatesEdit from './pages/associate/associates/AssociateEdit.vue';




export default [

    //auth
    {
        path: '/login',
        name: 'admin.login',
        component: Login,
    },

    //ADMIN ROUTES

    //admins
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: Dashboard,
    },
    {
        path: '/admin/admins',
        name: 'admin.admins',
        component: AdminIndex,
    },
    {
        path: '/admin/admins/create',
        name: 'admin.admins.create',
        component: AdminCreate,
    },
    {
        path: '/admin/admins/:id',
        name: 'admin.admins.show',
        component: AdminShow,
    },
    {
        path: '/admin/admins/:id/edit',
        name: 'admin.admins.edit',
        component: AdminEdit,
    },


    //Manager

    {
        path: '/admin/managers',
        name: 'admin.manager',
        component: ManagerIndex,
    },
    {
        path: '/admin/managers/create',
        name: 'admin.manager.create',
        component: ManagerCreate,
    },
    {
        path: '/admin/managers/:id',
        name: 'admin.manager.show',
        component: ManagerShow,
    },
    {
        path: '/admin/managers/:id/edit',
        name: 'admin.manager.edit',
        component: ManagerEdit,
    },
    //Associates

    {
        path: '/admin/associates',
        name: 'admin.associate',
        component: AssociateIndex,
    },
    {
        path: '/admin/associates/create',
        name: 'admin.associate.create',
        component: AssociateCreate,
    },
    {
        path: '/admin/associates/:id',
        name: 'admin.associate.show',
        component: AssociateShow,
    },
    {
        path: '/admin/associates/:id/edit',
        name: 'admin.associate.edit',
        component: AssociateEdit,
    },


    //Expenses

    {
        path: '/admin/expenses',
        name: 'admin.expense',
        component: ExpensesIndex,
    },
    {
        path: '/admin/expenses/create',
        name: 'admin.expense.create',
        component: ExpensesCreate,
    },
    {
        path: '/admin/expenses/:id',
        name: 'admin.expense.show',
        component: ExpensesShow,
    },
    {
        path: '/admin/expenses/:id/edit',
        name: 'admin.expense.edit',
        component: ExpensesEdit,
    },

    //Event

    {
        path: '/admin/events',
        name: 'admin.event',
        component: EventsIndex,
    },
    {
        path: '/admin/events/create',
        name: 'admin.event.create',
        component: EventsCreate,
    },
    {
        path: '/admin/events/:id',
        name: 'admin.event.show',
        component: EventsShow,
    },
    {
        path: '/admin/events/:id/edit',
        name: 'admin.event.edit',
        component: EventsEdit,
    },

    //Calendar

    {
        path: '/admin/calendars',
        name: 'admin.calendars',
        component: CalendarsIndex,
    },

    //Notifications

    {
        path: '/admin/notifications',
        name: 'admin.notifications',
        component: NotificationsIndex,
    },

    //Configurations

    {
        path: '/admin/configurations',
        name: 'admin.configurations',
        component: ConfigurationsIndex,
    },
    //Quotes

    {
        path: '/admin/quotes',
        name: 'admin.quote',
        component: QuotesIndex,
    },
    {
        path: '/admin/quotes/create',
        name: 'admin.quote.create',
        component: QuotesCreate,
    },
    {
        path: '/admin/quotes/:id',
        name: 'admin.quote.show',
        component: QuotesShow,
    },
    {
        path: '/admin/quotes/:id/edit',
        name: 'admin.quote.edit',
        component: QuotesEdit,
    },


    {
        path: '/admin/activity',
        name: 'admin.activity',
        component: ActivityIndex,
    },
    {
        path: '/admin/activity/create',
        name: 'admin.activity.create',
        component: ActivityCreate,
    },


     //MANAGER ROUTES

     {
        path: '/manager/dashboard',
        name: 'manager.dashboard',
        component: DashboardManager,
    },

    //Manager

    {
        path: '/manager/managers',
        name: 'manager.manager',
        component: ManagerManagerIndex,
    },
    {
        path: '/manager/managers/create',
        name: 'manager.manager.create',
        component: ManagerManagerCreate,
    },
    {
        path: '/manager/managers/:id',
        name: 'manager.manager.show',
        component: ManagerManagerShow,
    },
    {
        path: '/manager/managers/:id/edit',
        name: 'manager.manager.edit',
        component: ManagerManagerEdit,
    },
    //Associates

    {
        path: '/manager/associates',
        name: 'manager.associate',
        component: ManagerAssociateIndex,
    },
    {
        path: '/manager/associates/create',
        name: 'manager.associate.create',
        component: ManagerAssociateCreate,
    },
    {
        path: '/manager/associates/:id',
        name: 'manager.associate.show',
        component: ManagerAssociateShow,
    },
    {
        path: '/manager/associates/:id/edit',
        name: 'manager.associate.edit',
        component: ManagerAssociateEdit,
    },

    //Expenses

    {
        path: '/manager/expenses',
        name: 'manager.expense',
        component: ManagerExpensesIndex,
    },
    {
        path: '/manager/expenses/create',
        name: 'manager.expense.create',
        component: ManagerExpensesCreate,
    },
    {
        path: '/manager/expenses/:id',
        name: 'manager.expense.show',
        component: ManagerExpensesShow,
    },
    {
        path: '/manager/expenses/:id/edit',
        name: 'manager.expense.edit',
        component: ManagerExpensesEdit,
    },

      //Quotes

      {
        path: '/manager/quotes',
        name: 'manager.quote',
        component: ManagerQuotesIndex,
    },
    {
        path: '/manager/quotes/create',
        name: 'manager.quote.create',
        component: ManagerQuotesCreate,
    },
    {
        path: '/manager/quotes/:id',
        name: 'manager.quote.show',
        component: ManagerQuotesShow,
    },
    {
        path: '/manager/quotes/:id/edit',
        name: 'manager.quote.edit',
        component: ManagerQuotesEdit,
    },

     //Event

     
    {
        path: '/manager/events',
        name: 'manager.event',
        component: ManagerEventsIndex,
    },
    {
        path: '/manager/events/create',
        name: 'manager.event.create',
        component: ManagerEventsCreate,
    },
    {
        path: '/manager/events/:id',
        name: 'manager.event.show',
        component: ManagerEventsShow,
    },
    {
        path: '/manager/events/:id/edit',
        name: 'manager.event.edit',
        component: ManagerEventsEdit,
    },

    //Calendar

    {
        path: '/manager/calendars',
        name: 'manager.calendars',
        component: ManagerCalendarsIndex,
    },

    //Notifications

    {
        path: '/manager/notifications',
        name: 'manager.notifications',
        component: ManagerNotificationsIndex,
    },

    //Configurations

    {
        path: '/manager/configurations',
        name: 'manager.configurations',
        component: ManagerConfigurationsIndex,
    },

    //ASSOCIATE ROUTES

    {
        path: '/associate/dashboard',
        name: 'associate.dashboard',
        component: DashboardAssociate,
    },

    //QUOTES
    //Quotes

    {
        path: '/associate/quotes',
        name: 'associate.quote',
        component: AssociateQuotesIndex,
    },
    {
        path: '/associate/quotes/create',
        name: 'associate.quote.create',
        component: AssociateQuotesCreate,
    },
    {
        path: '/associate/quotes/:id',
        name: 'associate.quote.show',
        component: AssociateQuotesShow,
    },
    {
        path: '/associate/quotes/:id/edit',
        name: 'associate.quote.edit',
        component: AssociateQuotesEdit,
    },

    //Calendar

    {
        path: '/associate/calendars',
        name: 'associate.calendars',
        component: AssociateCalendarsIndex,
    },

    //Notifications

    {
        path: '/associate/notifications',
        name: 'associate.notifications',
        component: AssociateNotificationsIndex,
    },

    //Configurations

    {
        path: '/associate/configurations',
        name: 'associate.configurations',
        component: AssociateConfigurationsIndex,
    },

    //Events

    {
        path: '/associate/events',
        name: 'associate.event',
        component: AssociateEventsIndex,
    },
   
    {
        path: '/associate/events/:id',
        name: 'associate.event.show',
        component: AssociateEventsShow,
    },

    //Associate

    {
        path: '/associate/associates',
        name: 'associate.associates',
        component: AssociateAssociatesIndex,
    },

    {
        path: '/associate/associates/edit',
        name: 'associate.associates.edit',
        component: AssociateAssociatesEdit,
    },

    





]

// export default [
//     {
//         path: '/admin/dashboard',
//         name: 'admin.dashboard',
//         component: Dashboard,
//     },
//     {
//         path: '/admin/products',
//         name: 'admin.products',
//         component: Products,
//     },
//     {
//         path: '/admin/expenses',
//         name: 'admin.expenses',
//         component: Expenses,
//     },
//     {
//         path: '/admin/categories',
//         name: 'admin.categories',
//         component: Categories,
//     },
//     {
//         path: '/admin/categories/create',
//         name: 'admin.categories.create',
//         component: CreateCategories,
//     },
//     {
//         path: '/admin/categories/:id/edit',
//         name: 'admin.categories.edit',
//         component: EditCategories,
//     },
//     {
//         path: '/admin/categories/:id/show',
//         name: 'admin.categories.show',
//         component: ShowCategories,
//     }
// ]