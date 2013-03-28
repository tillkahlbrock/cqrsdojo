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
            type: 'text',
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

    var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
        clicksToMoveEditor: 1,
        autoCancel: false
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
        tbar: [{
            text: 'Add Affiliate',
            handler : function() {
                rowEditing.cancelEdit();

                // Create a model instance
                var newAffiliate = Ext.create('Affiliate', {
                    name: 'New Guy',
                    country: 'USrael'
                });

                Ext.data.StoreManager.lookup('affiliateStore').insert(0, newAffiliate);
                rowEditing.startEdit(0, 0);
            }
        }, {
            text: 'Remove Affiliate',
            handler: function() {
                var store = Ext.data.StoreManager.lookup('affiliateStore');

                var selectionModel = grid.getSelectionModel();
                rowEditing.cancelEdit();
                store.remove(selectionModel.getSelection());
                if (store.getCount() > 0) {
                    selectionModel.select(0);
                }
            },
            disabled: true
        }],
        selType: 'cellmodel',
        plugins: [
            'rowediting'
        ],
        height: 200,
        width: 400,
        renderTo: Ext.getBody()
    });

});