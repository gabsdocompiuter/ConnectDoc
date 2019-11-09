import React, { useState } from 'react';
import {
    View,
    Text,
    Image,
    StyleSheet,
} from 'react-native';

import BeautyInputText from './components/beautyInputText';

export default function () {
    return (
        <View style={styles.container}>
            <Image
                source={require('./assets/logo.png')}
                style={styles.logo}
            />

            <View style={styles.body}>
                <BeautyInputText
                    type='username'
                    placeholder='Usuário/CPF'
                    style={styles.input}
                ></BeautyInputText>
            </View>

            <View style={styles.footer}>
                <Text style={styles.text}>Aplicativo desenvolvido pelo Time Zetta</Text>
            </View>
        </View>
    );
};

const styles = StyleSheet.create({
    container:{
        flex: 1,
        backgroundColor: '#2B90F4',
    },

    text:{
        color: '#FFF',
        fontSize: 17,
        fontFamily: '',
    },
    
    logo:{
        flex: 3,
        resizeMode: 'contain',
        width: '100%',
    },
    
    body:{
        flex: 8,
        alignItems: 'center',
    },

    input: {
        width: 270,
        margin: 10,
    },

    footer:{
        flex: 1,
        
        justifyContent: 'center',
        alignItems: 'center',
    },

});
