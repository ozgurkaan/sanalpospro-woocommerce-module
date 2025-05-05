import { registerPaymentMethod } from '@woocommerce/blocks-registry';
import { getSetting } from '@woocommerce/settings';

const settings = getSetting('sanalpospro_data', {});

const SanalPosPROComponent = ({ eventRegistration, emitResponse }) => {
    const { onPaymentProcessing } = eventRegistration;

    useEffect(() => {
        const unsubscribe = onPaymentProcessing(() => {
            
            emitResponse.responseSuccess();
        
        });
        return () => unsubscribe();
    }, [onPaymentProcessing]);

    return (
        <div>
            <p>{settings.description}</p>
            {/*block-integration */}
        </div>
    );
};

registerPaymentMethod({
    name: 'sanalpospro-payment-module',
    label: settings.title,
    content: <SanalPosPROComponent />,
    edit: <SanalPosPROComponent />,
    canMakePayment: () => true,
    ariaLabel: settings.title,
    supports: {
        features: settings.supports,
    },
});

