Ext.require([
    'Ext.form.*',
    'Ext.data.*',
    'Ext.grid.*'
]);

Ext.onReady(function(){

    Ext.define('Affiliate', {
        extend: 'Ext.data.Model',
        fields: [{
            name: 'id',
            type: 'int',
            useNull: false
        }, 'name', 'country']
    });


    Ext.create('Ext.data.Store', {
        storeId:'affiliateStore',
        model: 'Affiliate',
        proxy: {
            type: 'rest',
            url : '/api/affiliate'
        },
        autoLoad: true,
        autoSync: true
    });

    Ext.create('Ext.grid.Panel', {
        title: 'Affiliates',
        store: Ext.data.StoreManager.lookup('affiliateStore'),
        columns: [
            {header: 'Id',  dataIndex: 'id'},
            {header: 'Name',  dataIndex: 'name', editor: 'textfield'},
            {header: 'Country', dataIndex: 'country', flex:1,
                editor: {
                    xtype: 'textfield',
                    allowBlank: false
                }
            }
        ],
        selType: 'cellmodel',
        plugins: [
            Ext.create('Ext.grid.plugin.CellEditing', {
                clicksToEdit: 1
            })
        ],
        height: 200,
        width: 400,
        renderTo: Ext.getBody()
    });

});